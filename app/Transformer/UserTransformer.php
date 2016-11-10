<?php

namespace App\Transformer;


/**
 * Class LessonTransformer
 * @package App\Transformer
 */
class UserTransformer extends Transformer
{

    /**
     * @param $lesson
     * @return array
     */
    public function transform($user){
        return [
            'name' => $user['name'],
            'mobile' => $user['mobile'],
        ];
    }

}