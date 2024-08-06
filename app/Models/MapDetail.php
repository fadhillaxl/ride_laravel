<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapDetail extends Model
{
    use HasFactory;
    public function makeExecCall($place)
    {
        $command = "php -f " . base_path('app/Models/map_exec.php') . " " . escapeshellarg($place);
        $output = shell_exec($command);
        $json_string = substr($output, strpos($output, '{'));
        // return response()->json($output);

        return json_decode($json_string);
    }
}

