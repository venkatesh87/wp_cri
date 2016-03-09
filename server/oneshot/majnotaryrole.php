<?php
/**
 * Description of majnotaryrole.php
 *
 * @package wp_cridon
 * @author eTech
 * @contributor Joelio
 */

// set utf-8 encoding
header('Content-type: text/html; charset=utf-8');

// load WP Core
require_once '../wp-load.php';

// init action
MajNotaryRole::init();

/**
 * Class MajNotaryRole
 */
class MajNotaryRole
{
    /**
     * @var mixed : wpdb global var
     */
    protected static $wpdb;

    /**
     * @var int : number total of items
     */
    protected static $nbItems;

    /**
     * @var int : limit of processing block
     */
    protected static $limit = 1000;

    /**
     * @var int : offset of query limit
     */
    protected static $offset = 0;

    /**
     * Init action
     */
    public static function init()
    {
        global $wpdb;

        try {
            // show starting message
            echo "Maj Notary role starting, please wait...\n";

            // set global var
            self::$wpdb = $wpdb;

            // init flag
            $i = 1;

            // nb items
            self::setNbItems();

            // set role
            self::setDefaultRole($i);

            // success output msg
            echo "Action done \n";
        } catch (\Exception $e) {
            // output error message
            echo $e->getMessage() . "\n";
        }
    }

    /**
     * Get number total of items
     *
     * @return void
     */
    private function setNbItems()
    {
        $sql = 'SELECT COUNT(*) as NB FROM ' . self::$wpdb->prefix . 'notaire';

        $res = self::$wpdb->get_row($sql);

        self::$nbItems = ($res->NB) ? $res->NB : 0;
    }

    /**
     * @param int $i
     * @return void
     */
    private function setDefaultRole($i)
    {
        // increase memory limit
        ini_set('memory_limit', '-1');

        // set max limit
        $limitMax = intval(self::$nbItems / self::$limit) + 1;

        // repeat action until limit max
        if ($i <= $limitMax) {

            // query
            $sql = 'SELECT * FROM ' . self::$wpdb->prefix . 'notaire';
            $sql .= ' LIMIT ' . self::$limit . ' OFFSET ' . intval(self::$offset);

            // exec query
            $notaries = self::$wpdb->get_results($sql);

            // maj notary role
            self::addRole($notaries);
            /**
             * example call remove role
             */
//            self::removeRole($notaries, 'finance');

            // increments offset
            self::$offset += self::$limit;
            // increments flag
            $i ++;
            // call set role action
            self::setDefaultRole($i);
        }
    }

    /**
     * @param mixed $notaries
     * @return void
     */
    private function addRole($notaries)
    {
        // list not empty
        if (is_array($notaries) && count($notaries) > 0) {
            foreach ($notaries as $notary) {
                // get user by id
                $user = new WP_User($notary->id_wp_user);
                // user must be an instance of WP_User vs WP_Error
                if ($user instanceof WP_User) {
                    // default role
                    $user->add_role(CONST_NOTAIRE_ROLE);
                    /**
                     * finance role
                     * to be matched in list of authorized user by function
                     *
                     * @see \Config::$canAccessFinance
                     */
                    if (in_array($notary->id_fonction, Config::$canAccessFinance)) {
                        $user->add_role(CONST_FINANCE_ROLE);
                    }
                }
            }
        }
    }

    /**
     * Removing roles
     * like a rollback action
     *
     * @param mixed $notaries
     * @param string $option : flag of specific role to be removed
     *
     * @return void
     */
    private function removeRole($notaries, $option = 'all')
    {
        // list not empty
        if (is_array($notaries) && count($notaries) > 0) {
            foreach ($notaries as $notary) {
                // get user by id
                $user = new WP_User($notary->id_wp_user);
                // user must be an instance of WP_User vs WP_Error
                if ($user instanceof WP_User) {
                    switch ($option) {
                        // default role
                        case 'default':
                            $user->remove_role(CONST_NOTAIRE_ROLE);
                            break;
                        // finance role
                        case 'finance':
                            $user->remove_role(CONST_FINANCE_ROLE);
                            break;
                        // all
                        default :
                            $user->remove_role(CONST_NOTAIRE_ROLE);
                            $user->remove_role(CONST_FINANCE_ROLE);
                            break;
                    }
                }
            }
        }
    }
}