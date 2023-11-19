<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Http\Request;

class Dashboard extends Component
{
    public $totalimagenes;
    public $totalaudios;
    public $totaldocumentos;
    public $totalvideos;

    //datos del disco
    public $diskuse;
    public $disk_used_size;
    public $total_disk_size;

    // //datos de cpu y disco
    // public $memory='30';
    // public $used_memory_in_gb='30';
    // public $total_ram='30';
    // public $load_width='30';
    // public $load='30';

    public function mount(){
        $this->totalimagenes=Post::where('category_id', 1)->count();
        $this->totalaudios=Post::where('category_id', 2)->count(); 
        $this->totaldocumentos=Post::where('category_id', 3)->count(); 
        $this->totalvideos=Post::where('category_id', 4)->count(); 
        //dd(disk_total_space('/'));    
        $this->check_disk_space();     
        // $this->total_ram_cpu();
    }

    public function check_disk_space() {

        $total_disk = disk_total_space('/');
        $this->total_disk_size = $total_disk / 1073741824;

        $free_disk = disk_free_space('/');
        $used_disk = $total_disk - $free_disk;

        $this->disk_used_size = $used_disk / 1073741824;
        $use_disk = round(100 - (($this->disk_used_size / $this->total_disk_size) * 100));

        $this->diskuse = round(100 - ($use_disk)) . '%';       
    }

    // //para revisar la cpu y la ram
    // public function total_ram_cpu() {

    //     # RAM usage
    //     $free = shell_exec('free');
    //     $free = (string) trim($free);
    //     $arr_free = explode("\n", $free);
    //     $memorys = explode(" ", $arr_free[1]);
    //     $memorys = array_filter($memorys);
    //     $memorys = array_merge($memorys);
    //     $used_memorys = $memorys[2];
    //     $used_memory_in_gb = number_format($used_memorys / 1048576, 2) . ' GB';
    //     $memory_first = $memorys[2] / $memorys[1] * 100;
    //     $this->memory = round($memory_first) . '%';
        
    //     $fh = fopen('/proc/meminfo', 'r');
    //     $memory_count = 0;
    //     while ($line = fgets($fh)) {
    //         $piece = array();
    //         if (preg_match('/^MemTotal:\s+(\d+)\skB$/', $line,
    //             $piece)) {
    //             $memory_count = $piece[1];
    //             break;
    //         }
    //     }

    //     fclose($fh);
    //     $total_ram = number_format($memory_count / 1048576, 2) . ' GB';

    //     # cpu usage
    //     $cpu_loaded = sys_getloadavg();
    //     $load_width = $cpu_loaded[0];
    //     $load = $cpu_loaded[0] . '% / 100%';

    //   //  return view('display',compact('memory','total_ram','used_memory_in_gb','load','load_width'));
    // }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
