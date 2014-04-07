<?php
namespace SimpleConMan;

/**
 * An implementation of the caverphone algorithm.
 *
 * Written mostly for fun and a bit for figuring out regexp. Turns out I didn't need to figure a lot out, but it was  bit
 * fun nevertheless.
 *
 * My version also features a modified mode that omits the last two steps, making string length variable, as well as a
 * function to encode entire paragraphs.
 */
class Caverphone
{
    public static function encode_para($paragraph, $preserve_space = true, $modified = true)
    {
        $paragraph_array = explode(' ', $paragraph);

        foreach ($paragraph_array as $word) {
            $paragraph_encoded_array[] = self::encode($word, $modified);
        }

        $paragraph = implode(($preserve_space ? ' ' : ''), $paragraph_encoded_array);

        return $paragraph;
    }

    public static function encode($name, $modified = false)
    {
        $name = strtolower($name);
        $name = preg_replace('/[^a-z]/', '', $name);

        $replace_start = array(
            'cough' => 'cou2f',
            'rough' => 'rou2f',
            'tough' => 'tou2f',
            'enough' => 'enou2f',
            'gn' => '2n',
        );
        foreach ($replace_start as $key => $value) {
            $name = preg_replace('/^' . $key . '/', $value, $name);
        }

        $replace_end = array('mb' => 'm2', );
        foreach ($replace_end as $key => $value) {
            $name = preg_replace('/' . $key . '$/', $value, $name);
        }

        $replace_all = array(
            'cq' => '2q',
            'ci' => 'si',
            'ce' => 'se',
            'cy' => 'sy',
            'tch' => '2ch',
            'c' => 'k',
            'q' => 'k',
            'x' => 'k',
            'v' => 'f',
            'dg' => '2g',
            'tio' => 'sio',
            'tio' => 'sia',
            'd' => 't',
            'ph' => 'fh',
            'b' => 'p',
            'sh' => 's2',
            'z' => 's',
            '^[aeiouy]' => 'A',
            '[aeiouy]' => '3',
            '3gh3' => '3kh3',
            'gh' => '22',
            'g' => 'k',
            's+' => 'S',
            't+' => 'T',
            'p+' => 'P',
            'k+' => 'K',
            'f+' => 'F',
            'm+' => 'M',
            'n+' => 'N',
            'w3' => 'W3',
            'wy' => 'Wy',
            'wh3' => 'Wh3',
            'why' => 'Why',
            'w' => '2',
            '^h' => 'A',
            'h' => '2',
            'r3' => 'R3',
            'ry' => 'Ry',
            'r' => '2',
            'l3' => 'L3',
            'ly' => 'Ly',
            'l' => '2',
            'j' => 'y',
            'y3' => 'Y3',
            'y' => '2',
        );
        foreach ($replace_all as $key => $value) {
            $name = preg_replace('/' . $key . '/', $value, $name);
        }

        $name = preg_replace('/[23]/', '', $name);

        if ($modified !== true) {
            $name = $name . '111111';
            $name = substr($name, 0, 6);
        }

        return $name;
    }

}
