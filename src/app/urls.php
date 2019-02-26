<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * @SWG\Definition(
 *  definition="urls",
 *  @SWG\Property(
 *      property="id",
 *      type="integer"
 *  ),
 *  @SWG\Property(
 *      property="url",
 *      type="string"
 *  ),
 *  @SWG\Property(
 *      property="surl",
 *      type="string"
 *  ),
*   @SWG\Property(
 *      property="hits",
 *      type="integer"
 *  ),
 *   @SWG\Property(
  *      property="user_id",
  *      type="integer"
  *  ),
 * )
 */
class urls extends Model
{
    protected $table = 'urls';
    public $timestamps = false;
}
