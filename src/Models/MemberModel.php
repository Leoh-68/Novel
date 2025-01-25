<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.0
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Models;
use NINA\Database\Eloquent\Factories\HasFactory;
use NINA\Database\Eloquent\Authenticate;
use NINA\Database\Eloquent\Model;
use NINA\Traits\TraitAttr;
class MemberModel extends Authenticate
{
    use HasFactory;
    public $timestamps = false;
    protected $guard = "member";
    protected $table = 'member';
    protected $guarded = [];
    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'password' => 'hashed'
    ];
    protected string $username = 'email';
    protected string $password = 'password';

    public function product(): \NINA\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductModel::class, 'id_member', 'id')->where('type', 'chuong-truyen');
    }
}