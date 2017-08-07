<?php

/**
 * Created by PhpStorm.
 * User: Jinming
 * Date: 2017/8/7
 * Time: 17:34
 */
namespace Lanizz\PhpHelper;

class Arr
{
    //------------------------------------------------------------------------------
    /**
     * 将数组转成Json字符串, 数组中包含中文时需要, 否则直接使用json_encode
     * @param   array $vArray 需要转换的数组
     * @return  string        成功返回转换后的Json字符串
     */
    static public function cnJsonEncode($vArray)
    {
        $tUrlEcData = self::jsonUrlEncode($vArray);
        $vJsnDcData = json_encode($tUrlEcData);
        return urldecode($vJsnDcData);
    }

    //------------------------------------------------------------------------------
    /**
     * 将数组中所有的值做urlencode转换, 转换中文字符
     * @param   array $vArray 需要转换的数组
     * @return  array         成功返回转换后的数组
     */
    static private function jsonUrlEncode($vArray)
    {
        if (is_array($vArray) || is_object($vArray)) {
            foreach ($vArray as $k => $v) {
                if (is_scalar($v)) {
                    if (is_array($vArray))
                        $vArray[$k] = urlencode($v);
                    elseif (is_object($vArray))
                        $vArray->$k = urlencode($v);
                } elseif (is_array($vArray))
                    $vArray[$k] = self::jsonUrlEncode($v);

                elseif (is_object($vArray))
                    $vArray->$k = self::jsonUrlEncode($v);
            }
        }
        return $vArray;
    }
}