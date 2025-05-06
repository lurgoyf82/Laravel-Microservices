<?php
    namespace App\Services;

    use Illuminate\Http\Request;

    class HeaderSanitizer
    {
        private array $allowed = ['Accept','Content-Type','Authorization','X-Request-ID'];

        public function forwardable(Request $req): array
        {
            $out = [];
            foreach ($this->allowed as $h) {
                if ($v = $req->header($h)) {
                    $out[$h] = $v;
                }
            }
            return $out;
        }
    }

