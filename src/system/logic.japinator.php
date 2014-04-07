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
class Japinator
{
    public static function encode($name, $characters)

    {
        $r = ($characters === 0 ? true : false);
        $k = ($characters === 1 ? true : false);
        $h = ($characters === 2 ? true : false);

        /**
         * Staffan Lindsgård
         * sutafan rinsugoodu
         * スタファン　リンスガーづ
         *
         * Staffan Lindsgård
         * staffan lindsgård
         * staffan lindsgord
         * stafan lindsgord
         * s ta fa n
         * su ta fa n
         * su ta fa n
         *
         * Carina Cederblad
         * karina sedeburadu
         * カリナ　セデブラづ
         */

        $name = strtolower($name);

        $special_chars = array(
            'é' => 'e',
            'É' => 'e',
            'å' => 'o',
            'Å' => 'o',
            'ä' => 'e',
            'Ä' => 'e',
            'ö' => 'u',
            'Ö' => 'u',
        );
        foreach ($special_chars as $from => $to) {
            $name = preg_replace('/' . $from . '/', $to, $name);
        }

        $name_array = explode(' ', $name);
        foreach ($name_array as $name) {

            $name_start = array(
                'berg' => 'barug',
                'sj' => '2',
                'ce' => 'se',
                'x' => 's',
            );
            foreach ($name_start as $from => $to) {
                $name = preg_replace('/^' . $from . '/', $to, $name);
            }

            $name_end = array(
                'berg' => '1',
                'ene' => 'en',
                'pel' => 'paru',
                'er' => 'a',
                'el' => 'eru',
                'b' => 'bu',
                'c' => 'ku',
                'd' => 'do',
                'f' => 'fu',
                'g' => 'gu',
                'h' => 'XX',
                'j' => 'i',
                'k' => 'ku',
                'l' => 'ru',
                'm' => 'mu',
                'p' => 'pu',
                'q' => 'XX',
                'r' => 'ru',
                's' => 'su',
                't' => 'tu',
                'v' => 'fu',
                'w' => 'XX',
                'x' => 'kusu',
                'z' => 'su',
            );
            foreach ($name_end as $from => $to) {
                $name = preg_replace('/' . $from . '$/', $to, $name);
            }

            $name_any = array(
                'ber' => 'ba',
                'per' => 'pa',
                'ch' => 'k',
                'ph' => 'f',
                'rt' => 't',
                'z' => 's',
            );
            foreach ($name_any as $from => $to) {
                $name = preg_replace('/' . $from . '/', $to, $name);
            }

            $name_not_start = array(
                'berg' => '1',
                'aud' => 'od',
                'aes' => 'as',
                'ber' => 'ba',
                'der' => 'da',
                'per' => 'pa',
                'ter' => 'ta',
                'ors' => 'os',
                'ck' => 'k',
                'sc' => 's-',
                'rd' => '-d',
                'rn' => '-n',
                'th' => 't-',
                'ie' => 'i-',
                'qv' => 'ku',
                'hl' => 'l',
                'x' => 'kus',
                'c' => 's',
                '1' => 'berigu',
            );
            foreach ($name_not_start as $from => $to) {
                $name = preg_replace('/(?<!^)' . $from . '/', $to, $name);
            }

            $double_consonants = array(
                'b',
                'd',
                'f',
                'g',
                'j',
                'l',
                'm',
                'n',
                'p',
                'r',
                's',
                't',
            );
            foreach ($double_consonants as $c) {
                $name = preg_replace('/' . $c . '{2}/', $c, $name);
            }

            $all_consonants = array(
                'b',
                'c',
                'd',
                'f',
                'g',
                'h',
                'j',
                'k',
                'l',
                'm',
                'p',
                'q',
                'r',
                's',
                't',
                'v',
                'w',
                'x',
                'z',
            );
            foreach ($all_consonants as $c1) {
                $all_consonants2 = $all_consonants;
                $all_consonants2[] = 'n';
                foreach ($all_consonants2 as $c2) {
                    $name = preg_replace('/' . $c1 . $c2 . '/', $c1 . 'u' . $c2, $name);
                }
            }

            $some_consonants = array(
                'dusu' => 'zu',
                'ca' => 'ka',
                'cu' => 'ku',
                'ce' => 'ke',
                'du' => 'do',
                'l' => 'r',
                'y' => 'i',
                'j' => 'y',
                '1' => 'berigu',
                '2' => 'sh',
            );
            foreach ($some_consonants as $from => $to) {
                $name = preg_replace('/' . $from . '/', $to, $name);
            }

            $some_vowels = array(
                'a',
                'i',
                'u',
                'e',
                'o',
            );
            foreach ($some_vowels as $vw) {
                $name = preg_replace('/' . $vw . $vw . '/', $vw, $name);
            }

            $name = preg_replace('/-/', '', $name);

            if ($k) {
                $rom2kat = array(
                    'tsu' => 'ツ',

                    'sha' => 'シャ',
                    'shi' => 'シ',
                    'shu' => 'シュ',
                    'she' => 'シェ',
                    'sho' => 'ショ',

                    'chi' => 'チ',

                    'ka' => 'カ',
                    'ki' => 'キ',
                    'ku' => 'ク',
                    'ke' => 'ケ',
                    'ko' => 'コ',

                    'sa' => 'サ',
                    'si' => 'シ',
                    'su' => 'ス',
                    'se' => 'セ',
                    'so' => 'ソ',

                    'ta' => 'タ',
                    'ti' => 'チ',
                    'tu' => 'ツ',
                    'te' => 'テ',
                    'to' => 'ト',

                    'na' => 'ナ',
                    'ni' => 'ニ',
                    'nu' => 'ヌ',
                    'ne' => 'ネ',
                    'no' => 'ノ',

                    'ha' => 'ハ',
                    'hi' => 'ヒ',
                    'hu' => 'フ',
                    'he' => 'ヘ',
                    'ho' => 'ホ',

                    'fa' => 'ファ',
                    'fi' => 'フィ',
                    'fu' => 'フ',
                    'fe' => 'フェ',
                    'fo' => 'フォ',

                    'ma' => 'マ',
                    'mi' => 'ミ',
                    'mu' => 'ム',
                    'me' => 'メ',
                    'mo' => 'モ',

                    'ya' => 'ヤ',
                    'yi' => 'イ',
                    'yu' => 'ユ',
                    'ye' => 'イェ',
                    'yo' => 'ヨ',

                    'ra' => 'ラ',
                    'ri' => 'リ',
                    'ru' => 'ル',
                    're' => 'レ',
                    'ro' => 'ロ',

                    'wa' => 'ワ',
                    'wi' => 'ウィ',
                    'wu' => 'ウ',
                    'we' => 'ウェ',
                    'wo' => 'ヲ',

                    'ga' => 'ガ',
                    'gi' => 'ギ',
                    'gu' => 'グ',
                    'ge' => 'ゲ',
                    'go' => 'ゴ',

                    'za' => 'ザ',
                    'zi' => 'ジ',
                    'zu' => 'ズ',
                    'ze' => 'ゼ',
                    'zo' => 'ゾ',

                    'ja' => 'ジャ',
                    'ji' => 'ジ',
                    'ju' => 'ジュ',
                    'je' => 'ジェ',
                    'jo' => 'ジョ',

                    'da' => 'ダ',
                    'di' => 'ヂ',
                    'du' => 'ヅ',
                    'de' => 'デ',
                    'do' => 'ド',

                    'ba' => 'バ',
                    'bi' => 'ビ',
                    'bu' => 'ブ',
                    'be' => 'ベ',
                    'bo' => 'ボ',

                    'pa' => 'パ',
                    'pi' => 'ピ',
                    'pu' => 'プ',
                    'pe' => 'ペ',
                    'po' => 'ポ',

                    'va' => 'ヴァ',
                    'vi' => 'ヴィ',
                    'vu' => 'ヴ',
                    've' => 'ヴェ',
                    'vo' => 'ヴォ',

                    'n' => 'ン',

                    'a' => 'ア',
                    'i' => 'イ',
                    'u' => 'ウ',
                    'e' => 'エ',
                    'o' => 'オ',
                );
                foreach ($rom2kat as $rom => $kat) {
                    $name = preg_replace('/' . $rom . '/', $kat, $name);
                }
            }

            if ($h) {
                $rom2kat = array(
                    'tsu' => 'つ',

                    'sha' => 'しゃ',
                    'shi' => 'し',
                    'shu' => 'しゅ',
                    'she' => 'しぇ',
                    'sho' => 'しょ',

                    'chi' => 'ち',

                    'ka' => 'か',
                    'ki' => 'き',
                    'ku' => 'く',
                    'ke' => 'け',
                    'ko' => 'こ',

                    'sa' => 'さ',
                    'si' => 'し',
                    'su' => 'す',
                    'se' => 'せ',
                    'so' => 'そ',

                    'ta' => 'た',
                    'ti' => 'ち',
                    'tu' => 'つ',
                    'te' => 'て',
                    'to' => 'と',

                    'na' => 'な',
                    'ni' => 'に',
                    'nu' => 'ぬ',
                    'ne' => 'ね',
                    'no' => 'の',

                    'ha' => 'は',
                    'hi' => 'ひ',
                    'hu' => 'ふ',
                    'he' => 'へ',
                    'ho' => 'ほ',

                    'fa' => 'ふぁ',
                    'fi' => 'ふぃ',
                    'fu' => 'ふ',
                    'fe' => 'ふぇ',
                    'fo' => 'ふぉ',

                    'ma' => 'ま',
                    'mi' => 'み',
                    'mu' => 'む',
                    'me' => 'め',
                    'mo' => 'も',

                    'ya' => 'や',
                    'yi' => 'い',
                    'yu' => 'ゆ',
                    'ye' => 'いぇ',
                    'yo' => 'よ',

                    'ra' => 'ら',
                    'ri' => 'り',
                    'ru' => 'る',
                    're' => 'れ',
                    'ro' => 'ろ',

                    'wa' => 'わ',
                    'wi' => 'うぃ',
                    'wu' => 'う',
                    'we' => 'うぇ',
                    'wo' => 'を',

                    'ga' => 'が',
                    'gi' => 'ぎ',
                    'gu' => 'ぐ',
                    'ge' => 'げ',
                    'go' => 'ご',

                    'za' => 'ざ',
                    'zi' => 'じ',
                    'zu' => 'ず',
                    'ze' => 'ぜ',
                    'zo' => 'ぞ',

                    'ja' => 'じゃ',
                    'ji' => 'じ',
                    'ju' => 'じゅ',
                    'je' => 'じぇ',
                    'jo' => 'じょ',

                    'da' => 'だ',
                    'di' => 'ぢ',
                    'du' => 'づ',
                    'de' => 'で',
                    'do' => 'ど',

                    'ba' => 'ば',
                    'bi' => 'び',
                    'bu' => 'ぶ',
                    'be' => 'べ',
                    'bo' => 'ぼ',

                    'pa' => 'ぱ',
                    'pi' => 'ぴ',
                    'pu' => 'ぷ',
                    'pe' => 'ぺ',
                    'po' => 'ぽ',

                    'va' => 'ヴぁ',
                    'vi' => 'ヴぃ',
                    'vu' => 'ヴ',
                    've' => 'ヴぇ',
                    'vo' => 'ヴぉ',

                    'n' => 'ん',

                    'a' => 'あ',
                    'i' => 'い',
                    'u' => 'う',
                    'e' => 'え',
                    'o' => 'お',
                );
                foreach ($rom2kat as $rom => $kat) {
                    $name = preg_replace('/' . $rom . '/', $kat, $name);
                }
            }

            $name_array_jap[] = $name;
        }

        $name = implode(' ', $name_array_jap);

        return $name;
    }

}
