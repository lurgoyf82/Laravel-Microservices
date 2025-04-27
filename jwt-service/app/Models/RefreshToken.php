<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class RefreshToken extends Model
    {
        protected $fillable = ['user_id','token','expires_at','revoked'];
        protected $dates = ['expires_at'];

        public function isExpired(): bool
        {
            return $this->expires_at->isPast();
        }
    }
