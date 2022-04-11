<?php
// Read the JSON file
$json = file_get_contents('./storage/restaurants.json');

// Decode the JSON file
$json_data = json_decode($json, true);

$dataToPush = $json_data['data'];

$interval = date_diff(DateTime::createFromFormat('U', $json_data['timestamp']), new DateTime());
$timeDifference = (new DateTime())->getTimestamp() - $json_data['timestamp'];


if ($timeDifference > 3600) {
    $ch1 = curl_init();

    curl_setopt($ch1, CURLOPT_URL, "http://eatandmeet.sk/tyzdenne-menu");

    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);

    $output1 = curl_exec($ch1);

    curl_close($ch1);

    $dom1 = new DOMDocument();

    @$dom1->loadHTML($output1);
    $dom1->preserveWhiteSpace = false;

    $parseNodes = ["day-1", "day-2", "day-3", "day-4", "day-5", "day-6", "day-7"];

    $foods1 = [
        ["date" => date('d.m.Y', strtotime('monday this week')), "day" => "Pondelok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('tuesday this week')), "day" => "Utorok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('wednesday this week')), "day" => "Streda", "menu" => []],
        ["date" => date('d.m.Y', strtotime('thursday this week')), "day" => "Štvrtok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('friday this week')), "day" => "Piatok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('saturday this week')), "day" => "Sobota", "menu" => []],
        ["date" => date('d.m.Y', strtotime('sunday this week')), "day" => "Nedeľa", "menu" => []],
    ];



    foreach ($parseNodes as $index => $nodeId) {

        $node = $dom1->getElementById($nodeId);

        foreach ($node->childNodes as $menuItem) {
            if ($menuItem && $menuItem->childNodes->item(1) && $menuItem->childNodes->item(1)->childNodes->item(3)) {
                $nazov = trim($menuItem->childNodes->item(1)->childNodes->item(3)->childNodes->item(1)->childNodes->item(1)->nodeValue);
                $cena = trim($menuItem->childNodes->item(1)->childNodes->item(3)->childNodes->item(1)->childNodes->item(3)->nodeValue);
                $popis = trim($menuItem->childNodes->item(1)->childNodes->item(3)->childNodes->item(3)->nodeValue);
                array_push($foods1[$index]["menu"], "$nazov ($popis): $cena");
            }
        }
    }

    $ch2 = curl_init();

    curl_setopt($ch2, CURLOPT_URL, "http://www.freefood.sk/menu/#fiit-food");

    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);

    $output2 = curl_exec($ch2);

    curl_close($ch2);

    $dom2 = new DOMDocument();

    @$dom2->loadHTML($output2);
    $dom2->preserveWhiteSpace = false;



    $foods2 = [
        ["date" => date('d.m.Y', strtotime('monday this week')), "day" => "Pondelok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('tuesday this week')), "day" => "Utorok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('wednesday this week')), "day" => "Streda", "menu" => []],
        ["date" => date('d.m.Y', strtotime('thursday this week')), "day" => "Štvrtok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('friday this week')), "day" => "Piatok", "menu" => []],
        ["date" => date('d.m.Y', strtotime('saturday this week')), "day" => "Sobota", "menu" => []],
        ["date" => date('d.m.Y', strtotime('sunday this week')), "day" => "Nedeľa", "menu" => []],
    ];



    $foodDiv = $dom2->getElementById("fiit-food");
    $dayList = $foodDiv->getElementsByTagName("ul")->item(0);


    foreach ($dayList->childNodes as $index => $den) {
        if ($den->tagName == "li") {
            foreach ($den->getElementsByTagName("li") as $jedlo) {
                array_push($foods2[$index - 1]["menu"], $jedlo->nodeValue);
            }
        }
    }


    $ch3 = curl_init();

    curl_setopt($ch3, CURLOPT_URL, "https://www.delikanti.sk/prevadzky/3-jedalen-prif-uk/");

    curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);

    $output3 = curl_exec($ch3);

    curl_close($ch3);

    $dom3 = new DOMDocument();

    @$dom3->loadHTML($output3);
    $dom3->preserveWhiteSpace = false;
    $tables = $dom3->getElementsByTagName('table');

    $rows = $tables->item(0)->getElementsByTagName('tr');
    $index = 0;
    $dayCount = 0;

    $foods3 = [];
    $foodCount = $rows->item(0)->getElementsByTagName('th')->item(0)->getAttribute('rowspan');

    foreach ($rows as $row) {

        if ($row->getElementsByTagName('th')->item(0)) {
            $foodCount = $row->getElementsByTagName('th')->item(0)->getAttribute('rowspan');

            $day = trim($rows->item($index)->getElementsByTagName('th')->item(0)->getElementsByTagName('strong')->item(0)->nodeValue);

            $th = $rows->item($index)->getElementsByTagName('th')->item(0);

            foreach ($th->childNodes as $node)
                if (!($node instanceof \DomText))
                    $node->parentNode->removeChild($node);

            $date = trim($rows->item($index)->getElementsByTagName('th')->item(0)->nodeValue);


            array_push($foods3, ["date" => $date, "day" => $day, "menu" => []]);

            for ($i = $index; $i < $index + intval($foodCount); $i++) {
                if ($foods3[$dayCount])
                    array_push($foods3[$dayCount]["menu"], trim($rows->item($i)->getElementsByTagName('td')->item(1)->nodeValue));
            }
            $index += intval($foodCount);
            $dayCount++;
        }

    }


    $dataToPush = [$foods1, $foods2, $foods3];


    $data = ["timestamp" => (new DateTime())->getTimestamp(), "data" => $dataToPush];

    $fp = fopen('./storage/restaurants.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);
}


echo json_encode($dataToPush);