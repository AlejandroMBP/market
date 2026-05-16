//<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
//class Role extends Model
//{
//
//    use SoftDeletes;
//    //asociado  a la tabla roles
//    protected $table = "roles";
//
//    //definimos a los campos que puede llamar ORM
//    protected $fillable = [
//        'nombre',
//        'descricion',
//        'estado',
//    ];
//
//    // tipos de dato automaticos
//    protected $casts = [
//        'estado'=>'boolean',
//    ];
//
//
//    public function users(){
//        return $this->hasMany(User::class);
//    }
//}
