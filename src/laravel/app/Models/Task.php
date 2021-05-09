<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'folders_id',
        'title',
        'due_date',
    ];

    const STATUS = [
        1 => [ 'number' => 1, 'label' => '未着手'],
        2 => [ 'number' => 2, 'label' => '着手中'],
        3 => [ 'number' => 3, 'label' => '完了'],
    ];

    public static function getStatusLabelAttribute($id)
    {        
        $tasks = self::where('folders_id', $id)->get();
        foreach ($tasks as $task) {
            switch ($task->status) {
                case 1:
                    $task->status = self::STATUS[1]['label'];
                    break;
                case 2:
                    $task->status = self::STATUS[2]['label'];
                    break;
                case 3:
                    $task->status = self::STATUS[3]['label'];
                    break;
                default:
                    break;
            }
    
            $task->due_date = date('Y/m/d', strtotime($task->due_date));
        }


        return $tasks;
    }

    public static function assignStatus()
    {
        $tasks = self::all();
        foreach ($tasks as $task) {
            switch ($task->status) {
                case 1:
                    $task->status = self::STATUS[1]['label'];
                    break;
                case 2:
                    $task->status = self::STATUS[2]['label'];
                    break;
                case 3:
                    $task->status = self::STATUS[3]['label'];
                    break;
                default:
                    break;
            }
        }
        return $tasks;
    }

    public static function ConvertTypeOfDueDate() // no used
    {
        $tasks = self::all();
        foreach ($tasks as $task) {
            $task->due_date = date('Y/m/d', strtotime($task->due_date));
        }
        return $tasks;
    }

    public static function selectTasksToEdit($id)
    {
        $tasks = self::assignStatus();
        foreach ($tasks as $task) {
            if ($id == $task->id) {
                return $task;
            }
        }

    }
}
