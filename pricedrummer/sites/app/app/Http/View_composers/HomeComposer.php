<?php
namespace App\Http\View_composers;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeComposer{
	public function compose(View $view)
	{
		//Fetch all the level one form the api
		$data = fetch_data('/api/v1/categories/?level=1&limit=1000');


        if(!empty($data) && isset($data->data)){
            $categories_raw = $data->data;
        }else{
            $categories_raw = [];
        }

		
		//Collect the level 3 categories for the level 1s and add them to the level 1 as category_children 
		$categories=[];
		foreach ($categories_raw as $key => $category) {
			$category_level1_id = $category->category_ID;
			$level3_data = fetch_data('/api/v1/categories/?get_my_3='.$category_level1_id.'&limit=1000');
			$category->category_children = $level3_data->data;
			$category->category_children_count = $level3_data->total;
			$categories[]=$category;
		}


		usort($categories, function($a, $b){
		    // return strcmp($a->category_children_count, $b->category_children_count);
		    return $a->category_children_count < $b->category_children_count;
		});

		$Base_Url = baseURL();
		switch ( $Base_Url ) {
			case "http://ng.pricedrummer.com":
		        //RETURN THE COUNTRY NAME
		        $country_name = "Nigeria";
		        $url_country_name = "nigeria";
		        $country_currency = '₦';
		        $country_code = "NG";
                $social_media    = [
                    "Blog"      => "http://blog.pricedrummer.com",
                    "Facebook"  => "https://www.facebook.com/PriceDrummerNG/",
                    "Instagram" => "https://www.instagram.com",
                    "Twitter"   => "https://www.twitter.com",
                    "LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
                ];
		        break;

		    case "http://za.pricedrummer.com":
		        //RETURN THE COUNTRY NAME
		        $country_name = "South Africa";
                $url_country_name = "southafrica";
		        $country_currency = 'ZAR';
                $country_code = "ZA";
                $social_media    = [
                    "Blog"      => "http://blog.pricedrummer.com",
                    "Facebook"  => "https://www.facebook.com/PriceDrummerZA",
                    "Instagram" => "https://www.instagram.com",
                    "Twitter"   => "https://www.twitter.com",
                    "LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
                ];
		        break;

		    case "http://ke.pricedrummer.com":
		        //RETURN THE COUNTRY NAME
		        $country_name = "Kenya";
                $url_country_name = "kenya";
		        $country_currency = 'KES';
                $country_code = "KE";
                $social_media    = [
                    "Blog"      => "http://blog.pricedrummer.com",
                    "Facebook"  => "https://www.facebook.com/PriceDrummerKE/",
                    "Instagram" => "https://www.instagram.com",
                    "Twitter"   => "https://www.twitter.com",
                    "LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
                ];
		        break;

		    case "http://gh.pricedrummer.com":
		        //RETURN THE COUNTRY NAME
		        $country_name = "Ghana";
                $url_country_name = "ghana";
		        $country_currency = 'GH¢';
                $country_code = "GH";
                $social_media    = [
                    "Blog"      => "http://blog.pricedrummer.com",
                    "Facebook"  => "http://www.facebook.com/PriceDrummerGH",
                    "Instagram" => "http://www.instagram.com/pricedrummer_gh/",
                    "Twitter"   => "http://twitter.com/PriceDrummer_GH",
                    "LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
                ];
		        break;

		    case "http://mu.pricedrummer.com":
		        //RETURN THE COUNTRY NAME
		        $country_name = "Mauritius";
                $url_country_name = "mauritius";
		        $country_currency = '₨';
                $country_code = "MU";
                $social_media    = [
                    "Blog"      => "http://blog.pricedrummer.com",
                    "Facebook"  => "https://www.facebook.com/PriceDrummerMU",
                    "Instagram" => "#",
                    "Twitter"   => "#",
                    "LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
                ];
		        break;

		    case "http://eg.pricedrummer.com":
		        //RETURN THE COUNTRY NAME
		        $country_name = "Egypt";
                $url_country_name = "nigeria";
		        $country_currency = '£';
                $country_code = "EG";
                $social_media    = [
                    "Blog"      => "http://blog.pricedrummer.com",
                    "Facebook"  => "https://www.facebook.com/PriceDrummerEG/",
                    "Instagram" => "https://www.instagram.com",
                    "Twitter"   => "https://www.twitter.com",
                    "LinkedIn"  => "https://www.linkedin.com/company-beta/15228908",
                ];
		        break;
		}

		$view->with('mega_categories', $categories)
            ->with('country_name', $country_name)
            ->with('country_currency', $country_currency)
            ->with('url_country_name', $url_country_name)
            ->with('country_code', $country_code)
            ->with('social_media', $social_media);
	}
}