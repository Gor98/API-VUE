<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class ArticleTest extends TestCase
{

    public function testGetAllArtiles()
    {

//        $structure = [
//            'id',
//            'title',
//            'body'
//        ];
//        $data = ['data' => $structure];
//
//        $structure = json_encode($structure);
//        $data = json_encode($data);
//
//     //  dd($data);


        $this->json('GET', '/api/articles')
                ->assertStatus(200)
//                ->assertJsonStructure(['data'=>
//                    [
//                        '*'=>[
//                            'id',
//                            'title',
//                            'body'
//                        ]
//                    ]
//                ]);
                ->assertJson(['data'=>true]);
    }

    public function testGetSigleArtiles(){

        $user_id = 5;

       $this->json('GET','api/article/'.$user_id)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data'=>
                        [
                            'id',
                            'title',
                            'body'
                        ]
            ]);

    }

    public function testDeleteArticle(){

        $user_id = 30;

        $this->json('Delete','api/article/'.$user_id)
            ->assertStatus(200)
            ->assertJsonStructure(['data'=>
                [
                    'id',
                    'title',
                    'body'
                ]
            ]);

    }


    public function testUpdateArticle(){

        $data = [
            'article_id' => 36,
            'title' => 'testing',
            'body' => 'testing testing testing testing'
        ];

        $this->json('PUT','api/article', $data)
            ->assertStatus(200)
            ->assertJsonStructure(['data'=>
                [
                    'id',
                    'title',
                    'body'
                ]
            ]);

    }

    public function testAddArticle(){

        $data = [
            'title' => 'testing',
            'body' => 'testing testing testing testing aaaa'
        ];

        $this->json('POST','api/article', $data)
            ->assertStatus(201)
            ->assertJsonStructure(['data'=>
                [
                    'id',
                    'title',
                    'body'
                ]
            ]);

    }



}

