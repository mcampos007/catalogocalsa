<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliendistri extends Model
{
    /**
     * The database connection used by the model.
     *
     * @var string
     */
     protected $connection = 'mysql2';

     /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $table = 'clientes';

     //Etc...
}
