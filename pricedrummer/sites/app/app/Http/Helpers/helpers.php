<?php

function cmp($a, $b)
{
    return strcmp($a->price, $b->price);
}

function fetch_data($api)
{
    // Store the original input of the request
    $originalInput = Request::input();

    // Create your request to your API
    $request = Request::create($api, 'GET');
    // Replace the input with your request instance input
    Request::replace($request->input());

    // Dispatch your request instance with the router
    $response = Route::dispatch($request);

    // Fetch the response
    $instance = json_decode(Route::dispatch($request)->getContent());

    // Replace the input again with the original request input.
    Request::replace($originalInput);
    return $instance;
}

function fetchJSON($filename)
{
    $path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json
    if (!File::exists($path)) {
        throw new Exception("Invalid File");
    }

    $file = File::get($path); // string

    return json_decode($file);

}

function fetch_mega_menu_categories()
{
    //Fetch all the level one form the api
    $data = fetch_data('/api/v1/categories/?level=1&limit=1000');
    $categories_raw = $data->data;

    //Collect the level 3 categories for the level 1s and add them to the level 1 as category_children
    $categories = [];
    foreach ($categories_raw as $key => $category) {
        $category_level1_id = $category->category_ID;
        $level3_data = fetch_data('/api/v1/categories/?get_my_3=' . $category_level1_id . '&limit=1000');
        $category->category_children = $level3_data->data;
        $categories[] = $category;
    }
    dd($categories);
}

function lowercase($value)
{
    return strtolower($value);
}

function spacelessUrl($value)
{
    return preg_replace("/\//", "-", preg_replace("/\s+/", "-", preg_replace("/[, ]+/", "-", $value)));
}

function ReformatID($value)
{
    $value = preg_replace("/ /", "_", $value);
    $value = preg_replace('/"/', "__", $value);
    $value = preg_replace("/'/", "VVVV", $value);
    $value = preg_replace("/:/", "www", $value);
    $value = preg_replace("/\//", "qqq", $value);
    $value = preg_replace("/\./", "zzz", $value);
    $value = preg_replace("/[|]/", "1111", $value);
    $value = preg_replace("/[(]/", "TTT", $value);
    $value = preg_replace("/[)]/", "YYY", $value);

    return $value;
}

function ReformatHTML($value)
{
    $value = preg_replace("/â€™/", "'", $value);
    $value = preg_replace("/â€œ/", '"', $value);
    $value = preg_replace("/â€/", '"', $value);

    return $value;
}
    
function remove_empty($array)
{
    return array_filter($array, function ($value) {
        return !empty($value) || $value === 0;
    });
}

function baseURL()
{
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) and $_SERVER['HTTPS'] == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"];
    }

    return $pageURL;
}

function get_country_name()
{
    switch (baseURL()) {
        case "http://localhost":
            //RETURN THE COUNTRY NAME
            return "Ghana";
            $country = "Ghana";
            break;

        case "http://ng.pricedrummer.com":
            //RETURN THE COUNTRY NAME
            echo "nigeria";
            $country = "nigeria";
            break;


        case "http://sa.pricedrummer.com":
            //RETURN THE COUNTRY NAME
            echo "southafrica";
            $country = "southafrica";
            break;

        case "http://ke.pricedrummer.com":
            //RETURN THE COUNTRY NAME
            echo "kenya";
            $country = "kenya";
            break;

        case "http://gh.pricedrummer.com":
            //RETURN THE COUNTRY NAME
            echo "ghana";
            $country = "ghana";
            break;

        case "http://mu.pricedrummer.com":
            //RETURN THE COUNTRY NAME
            echo "mauritius";
            $country = "mauritius";
            break;

        case "http://eg.pricedrummer.com":
            //RETURN THE COUNTRY NAME
            echo "egypt";
            $country = "egypt";
            break;
    }
}

function prepare_breadcrumb_levels($data)
{
    $breadcrumbs = [];
    if ($data->level == 3) {
        $level_2 = fetch_data('/api/v1/categories/' . $data->parent_id);
        $level_1 = fetch_data('/api/v1/categories/' . $level_2->parent_id);
        $breadcrumbs = [
            'L1' => $level_1,
            'L2' => $level_2,
            'L3' => $data
        ];
    } elseif ($data->level == 4) {
        $level_3 = fetch_data('/api/v1/categories/' . $data->parent_id);
        $level_2 = fetch_data('/api/v1/categories/' . $level_3->parent_id);
        $level_1 = fetch_data('/api/v1/categories/' . $level_2->parent_id);
        $breadcrumbs = [
            "L1" => $level_1,
            "L2" => $level_2,
            "L3" => $level_3,
            "L4" => $data
        ];
    }
    return $breadcrumbs;
}