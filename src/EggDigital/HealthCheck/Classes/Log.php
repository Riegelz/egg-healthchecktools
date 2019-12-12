<?php
namespace EggDigital\HealthCheck\Classes;

class Log
{
    public function writeLog($data, $path, $filename)
	{
        $file = $path.$filename;
        foreach ($data as $key => $value) {
            $text .= date("Y-m-d H:i:s") . " #### " .  $value . " ####\r\n";
        }
        if (file_exists($path.$filename)) {
            $countLine = Log::countLine($path, $filename);
        }
        if ($countLine > 20) {
            $handle = fopen($path.$filename, "w");
            fwrite($handle, $text);
            fclose($handle);
        }else{
            $handle = fopen($path.$filename, "a");
            fwrite($handle, $text);
            fclose($handle);
        }
    }
    
    public function countLine($path, $filename)
    {
        $linecount = 0;
        $handle = fopen($path.$filename, "r");
        while(!feof($handle)) {
            $line = fgets($handle);
            $linecount++;
        }
        fclose($handle);

        return $linecount;
    }
}
