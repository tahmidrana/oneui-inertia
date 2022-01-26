<?php
if (! function_exists('number_to_word')) {
    function number_to_word($num = '')
    {
        $num = (string) ((int) $num);

        if ((int) ($num) && ctype_digit($num)) {
            $words = array();

            $num = str_replace(array(',', ' '), '', trim($num));

            $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven',
                'eight', 'nine', 'ten', 'eleven', 'twelve', 'thirteen', 'fourteen',
                'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen');

            $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty',
                'seventy', 'eighty', 'ninety', 'hundred');

            $list3 = array('', 'thousand', 'million', 'billion', 'trillion',
                'quadrillion', 'quintillion', 'sextillion', 'septillion',
                'octillion', 'nonillion', 'decillion', 'undecillion',
                'duodecillion', 'tredecillion', 'quattuordecillion',
                'quindecillion', 'sexdecillion', 'septendecillion',
                'octodecillion', 'novemdecillion', 'vigintillion');

            $num_length = strlen($num);
            $levels = (int) (($num_length + 2) / 3);
            $max_length = $levels * 3;
            $num = substr('00' . $num, -$max_length);
            $num_levels = str_split($num, 3);

            foreach ($num_levels as $num_part) {
                $levels--;
                $hundreds = (int) ($num_part / 100);
                $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ($hundreds == 1 ? '' : '') . ' ' : '');
                $tens = (int) ($num_part % 100);
                $singles = '';

                if ($tens < 20) {
                    $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
                } else {
                    $tens = (int) ($tens / 10);
                    $tens = ' ' . $list2[$tens] . ' ';
                    $singles = (int) ($num_part % 10);
                    $singles = ' ' . $list1[$singles] . ' ';
                }
                $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_part)) ? ' ' . $list3[$levels] . ' ' : '');
            }

            $commas = count($words);

            if ($commas > 1) {
                $commas = $commas - 1;
            }

            $words = implode(', ', $words);

            //Some Finishing Touch
            //Replacing multiples of spaces with one space
            $words = trim(str_replace(' ,', ',', trim_all(ucwords($words))), ', ');
            if ($commas) {
                $words = str_replace_last(',', '&nbsp;', $words);
            }

            return $words;
        } elseif (!((int) $num)) {
            return 'Zero';
        }
        return '';
    }
}

if (! function_exists('trim_all')) {
    function trim_all($str, $what = null, $with = ' ')
    {
        if ($what === null) {
            //  Character      Decimal      Use
            //  "\0"            0           Null Character
            //  "\t"            9           Tab
            //  "\n"           10           New line
            //  "\x0B"         11           Vertical Tab
            //  "\r"           13           New Line in Mac
            //  " "            32           Space

            $what = "\\x00-\\x20"; //all white-spaces and control chars
        }

        return trim(preg_replace("/[" . $what . "]+/", $with, $str), $what);
    }
}

if (! function_exists('str_replace_last')) {
    function str_replace_last($search, $replace, $str)
    {
        if (($pos = strrpos($str, $search)) !== false) {
            $search_length = strlen($search);
            $str = substr_replace($str, $replace, $pos, $search_length);
        }
        return $str;
    }
}


// number_to_word( '2281941596' );

if (!function_exists('tenderStoreStatus')) {
    function tenderStoreStatus($Key)
    {
        $Value = array(
            '0' => 'In Progress',
            '1' => 'Delayed',
            '2' => 'Retender',
            '3' => 'Cancelled',
        );
        if (array_key_exists($Key, $Value)) {
            return $Value[$Key];
        }
    }
}

if (! function_exists('convert_number')) {
    function convert_number($number)
    {
        $my_number = $number;
        if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }
        $Kt = floor($number / 10000000); /* Koti */
        $number -= $Kt * 10000000;
        $Gn = floor($number / 100000); /* lakh  */
        $number -= $Gn * 100000;
        $kn = floor($number / 1000); /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100); /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10); /* Tens (deca) */
        $n = $number % 10; /* Ones */
        $res = "";
        if ($Kt) {
            $res .= convert_number($Kt) . " কোটি ";
        }
        if ($Gn) {
            $res .= convert_number($Gn) . " লক্ষ";
        }
        if ($kn) {
            $res .= (empty($res) ? "" : " ") .
            convert_number($kn) . " হাজার";
        }
        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .
            convert_number($Hn) . " শত";
        }
        $ones = array("", "এক", "দুই", "তিন", "চার", "পাঁচ", "ছয়",
            "সাত ", "আট ", "নয়", "দশ", "এগার ", "বার ", "তের",
            "চৌদ্দ", "পনের", "ষোল", "সতের", "আঠার ", "ঊনিশ",
            "বিশ", "একুশ", "বাইশ", "তেইশ", "চব্বিশ", "পঁচিশ", "ছাব্বিশ",
            "সাতাইশ", "আটাইশ", "ঊনত্রিশ", "ত্রিশ", "একত্রিশ", " বত্রিশ", "তেত্রিশ",
            "চৌত্রিশ", "পয়ত্রিশ", "ছত্রিশ", "সাতত্রিশ", "আটত্রিশ",
            "ঊনচল্লিশ", "চল্লিশ", "এক চল্লিশ", " বেয়াল্লিশ", "তেতাল্লিশ",
            "চুয়াল্লিশ", "পয়তাল্লিশ", "ছয় চল্লিশ", "সাত চল্লিশ",
            "আট চল্লিশ", "ঊন পঞ্চাশ", "পঞ্চাশ", "একান্ন", " বায়ান্ন", "তেপ্পান্ন", " চুয়ান্ন",
            "পঞ্চান্ন", "ছাপ্পান্ন", "সাতান্ন", "আটান্ন", "ঊনষাট", "ষাট", "একষট্টি",
            "বাষট্টি", "তেষট্টি", "চৌষট্টি", "পঁয়ষট্টি", "ছিষট্টি", "সাতষট্টি", "আটষট্টি", "ঊন সত্তর",
            "সত্তর", "একাত্তর", "বাহাত্তর", "তেহাত্তর", "চুয়াত্তর", "পঁচাত্তর", "ছিয়াত্তর",
            "সাতাত্তর", "আটাত্তুর ", "ঊনআশি", "আশি", "একাশি", "বিরাশি", "তিরাশি", "চুরাশি", "পঁচাশি",
            "ছিয়াশি", "সাতাশি", "আটাশি", "ঊননব্বই", "নব্বই", "একানব্বই", "বিরানব্বই", "তিরানব্বই", "চুরানব্বই",
            "পঁচানব্বই", "ছিয়ানব্বই", "সাতানব্বই", "আটানব্বই", "নিরানব্বই", "একশত");

        $tens = array("", "", "", "", "", "", "", "", "");
        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= "  ";
            }
            if ($Dn < 10) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                /*$res .= $tens[$Dn];
            if ($n)
            {
            $res .= "-" . $ones[$n];
            //$res .= " " ;
            }*/
            }
        }
        if (empty($res)) {
            $res = "শূন্য";
        }
        return $res;
    }
}
