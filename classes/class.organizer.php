<?php
// $current_path = dirname( __FILE__ ) ;
include 'inc/dateset.php';
include 'inc/lang.php';
// print_r($language);

class organizer_page {

	public $language = [];
	public $lang_long = [];
	public $lang_short = [];
	public $lang_iso = [];


	
	private $html = '';
	
		function __construct($language = ['en', 'es', 'nl']){
			$this-> language = $lang_iso = array(
				'en' => 'en-US',
				'es' => 'es-ES',
				'nl' => 'nl-NL',
				);

			if(!empty($language)){
				foreach($language as $lang_iso => $lang_long){
					$this->__set($lang_iso, $lang_long);
				}
			}
		}
	
	public function __set($lang_iso, $lang_long){ // set key and value in language property
		$this->language[$lang_iso] = $lang_long;
	}
  
	public function __get($lang_long){ // get property value
	  if(isset($this->language[$lang_long])) {
		  return $this->language[$lang_long];
	  }
	}
  
	public function getlanguage(){
	  return $this->language;
	}
	
}

//   $language = new organizer_page();
//   $language-> en = 'EN';
//   $language-> es = 'ES';
//   $language-> nl = 'NL';

// OR

$language = array(
	"1" => 'en',
	"2" => 'es',
	"3" => 'nl',
);



// var_dump($language);
// var_dump($lang_iso);
// var_dump($lang_txt);
// var_dump($lang_short);
// var_dump($lang_long);

// var_dump($day_names);
// var_dump($month_names);

//   $language = new organizer_page($language);
//   echo '<pre>'; print_r($language->getlanguage());
//   $res = (object)$language->getlanguage();

  
  //   echo '<pre>'; print_r($res);
  
  // var_dump($language);
// print_r($language);
// sort($day_names);
// print_r($day_names);
// print_r($month_names);
// var_dump($languages_long);





// <!-- // public function test(){
	// 	var_dump(get_object_vars($this));
	// 	}
	// }
	
	// // $test = new organizer;
	// // var_dump(get_object_vars($test));
	
	// // $test->test();
	
	// public $language = '';
	
	// public function __CONSTRUCT($language = 'en' )
	// {
		// 	$this ->language = $language;
		// }
		
		// private $html = ''; -->
		// <!-- 
		?>