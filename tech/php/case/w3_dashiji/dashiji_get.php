<?php
//var_dump($_GET);


//数据
$year_arr=[
	"year2017"=>[
		"year"=>2017,
		"month_arr"=>[
			[
				"month"=>1,
				"day_arr"=>[
					[
						"day"=>20,
						"cont"=>"1111容内容内容内容内容内容"
					],
					[
						"day"=>21,
						"cont"=>"1111容内容内容内容内容内容"
					],
					[
						"day"=>22,
						"cont"=>"1111容内容内容内容内容内容"
					]
					
				]
			],
			[
				"month"=>2,
				"day_arr"=>[
					[
						"day"=>1,
						"cont"=>"1111容内容内容内容内容内容"
					],
					[
						"day"=>2,
						"cont"=>"1111容内容内容内容内容内容"
					],
					[
						"day"=>3,
						"cont"=>"1111容内容内容内容内容内容"
					]
				]
			]
		]
	],

	"year2018"=>[
		"year"=>2018,
		"month_arr"=>[
			[
				"month"=>7,
				"day_arr"=>[
					[
						"day"=>10,
						"cont"=>"1111容内容内容内容内容内容"
					]
				]
			],
			[
				"month"=>8,
				"day_arr"=>[
					[
						"day"=>17,
						"cont"=>"1111容内容内容内容内容内容"
					],
					[
						"day"=>18,
						"cont"=>"1111容内容内容内容内容内容"
					]
				]
			]
		]
	]
];



			
//echo json_encode($year_arr["year{$_GET['year']}"]);


//-----------------------------------------
function ryear($y){
	echo json_encode($y["year{$_GET['year']}"]);
};
	
ryear( $year_arr );
