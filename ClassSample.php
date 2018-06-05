<?php

require_once "ClassCache.php";

class ClassSample extends ClassCache 
{
    /**
     * @param integer $user_id
     * @return array records info
     */
    static function getUserInfo($user_id)
    {
        $rows = self::_cacheGet($user_id);
        if(is_null($rows))
        {
            $rows = self::_selectDB($user_id);
            self::_cacheSet($user_id, $rows);
        }
        return $rows;
    }

    /**
     * @param integer $user_id
     * @param array $data user info
     * @return bool
     */
    static function setUserInfo($user_id, $data)
    {
        $row = self::_selectDB($user_id);
        if(count($row) === 0)
        {
            self::_insertDB($user_id, $data);
        }
        else
        {
            self::_updateDB($user_id, $data);
        }
        self::_cacheClear($user_id);
        return true;
    }

    /**
     * @param integer $user_id
     * @return bool
     */
    static function deleteUserInfo($user_id)
    {
        $row = self::_selectDB($user_id);
        if(count($row) === 0)
        {
            return false;
        }

        self::_deleteDB($user_id);
        self::_cacheClear($user_id);
        return true;
    }

    /**
     * @param integer $user_id
     * @return array records info
     */
    private static function _selectDB($user_id)
    {
        $obj_db = connect_db(); //assumed to be usable
        $st = $obj_db->pquery("SELECT * FROM `sample_table` WHERE `user_id` = ?", $user_id);
        return $st->fetchAll();
    }

    /**
     * @param integer $user_id
     * @param array $data user info
     */
    private static function _insertDB($user_id, $data)
    {
        // The rest is omitted
    }

    /**
     * @param integer $user_id
     * @param array $data user info
     */
    private static function _updateDB($user_id, $data)
    {
        // The rest is omitted
    }

    /**
     * @param integer $user_id
     */
    private static function _deleteDB($user_id)
    {
        // The rest is omitted
    }
}