<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @SWG\Definition(
 *  definition="logs",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="time",
 *      type="DateTime"
 *  ),
 *  @SWG\Property(
 *      property="IP",
 *      type="string"
 *  ),
*   @SWG\Property(
 *      property="Action",
 *      type="Text"
 *  ),
 *  @SWG\Property(
  *      property="Status",
  *      type="Integer"
  *  ),
 * )
 */
class logs extends Model
{
      protected $table = 'logs';
      public $timestamps = false;

}
