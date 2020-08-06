<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cache extends Model
{
    /**
     * Table name in db.
     *
     * @var string
     */
    protected $table = "cache";

    /**
     * Default primary key.
     *
     * @var string
     */
    protected $primaryKey = 'key';
    
    /**
     * Turning default timestamp.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Key prefix.
     *
     * @var string
     */
    protected static $keyPrefix = "mk7_cache_";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value', 'expiration'
    ];

    /**
     * This function retreives data from cache if exist
     * @param string $key 
     */
    public static function get(string $key)
    {
        $key = self::$keyPrefix . $key;
        $data = self::find($key);
        if (!$data) {
            return false;
        }
        return $data->expiration > time() ? $data : false;
    }

    /**
     * This function stores data in cache table. It uses Map structure to store date <key, value>
     * @param string $key 
     * @param string $value value which should be stored in cache
     * @param int $expiration life-time 
     */
    public static function put(string $key, array $value, int $expiration)
    {
        $dataInCache = self::find(self::$keyPrefix . $key);
        if (!$dataInCache) {
            return self::create([
                "key" => self::$keyPrefix . $key,
                "value" => json_encode($value),
                "expiration" => time() + $expiration
            ]);
        }

        $dataInCache->update([
            "value" => json_encode($value),
            "expiration" => time() + $expiration
        ]);
    }
}
