<?php

use Illuminate\Database\Seeder;

class TonerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cartuchos')->insert([
        /*HP genéricos*/
        [
          'modelo'=>'410BK Genérico',
          'cantidad'=>0
        ],
        [
          'modelo'=>'411C Genérico',
          'cantidad'=>0
        ],
        [
          'modelo'=>'412Y Genérico',
          'cantidad'=>0
        ],
        [
          'modelo'=>'413M Genérico',
          'cantidad'=>0
        ],

        /*HP original*/

        [
          'modelo'=>'410BK Original',
          'cantidad'=>0
        ],
        [
          'modelo'=>'411C Original',
          'cantidad'=>0
        ],
        [
          'modelo'=>'412Y Original',
          'cantidad'=>0
        ],
        [
          'modelo'=>'413M Original',
          'cantidad'=>0
        ],

        /*131*/
        [
          'modelo'=>'131BK',
          'cantidad'=>0
        ],
        [
          'modelo'=>'131C',
          'cantidad'=>0
        ],
        [
          'modelo'=>'131Y',
          'cantidad'=>0
        ],
        [
          'modelo'=>'131M',
          'cantidad'=>0
        ],

        /*TN336*/
        [
          'modelo'=>'TN336BK',
          'cantidad'=>0
        ],
        [
          'modelo'=>'TN336C',
          'cantidad'=>0
        ],
        [
          'modelo'=>'TN336Y',
          'cantidad'=>0
        ],
        [
          'modelo'=>'TN336M',
          'cantidad'=>0
        ],

        /*203*/
        [
          'modelo'=>'203U',
          'cantidad'=>0
        ],

        /*950*/
        [
          'modelo'=>'950xBK',
          'cantidad'=>0
        ],
        [
          'modelo'=>'951xC',
          'cantidad'=>0
        ],
        [
          'modelo'=>'951xY',
          'cantidad'=>0
        ],
        [
          'modelo'=>'951xM',
          'cantidad'=>0
        ],

        /*TN660*/
        [
          'modelo'=>'TN660',
          'cantidad'=>0
        ],
        [
          'modelo'=>'Tambor DR-630',
          'cantidad'=>0
        ],

        /*TN750*/
        [
          'modelo'=>'TN750',
          'cantidad'=>0
        ],

        /*255x*/
        [
          'modelo'=>'255x',
          'cantidad'=>0
        ]

      ]);
    }
}
