<?php
/******************************************************************************
 * NINA VIỆT NAM
 * Email: nina@nina.vn
 * Website: nina.vn
 * Version: 1.1.1 
 * Date 18-09-2024
 * Đây là tài sản của CÔNG TY TNHH TM DV NINA. Vui lòng không sử dụng khi chưa được phép.
 */


namespace NINA\Models;
use NINA\Database\Eloquent\Factories\HasFactory;
use NINA\Database\Eloquent\Model;
use NINA\Traits\TraitAttr;

class ProductSubModel extends Model
{
    use HasFactory,TraitAttr;
    protected $guarded = [];
    protected $table = 'product_sub';
    public function getItems($select = ['*'])
    {
        return $this->hasMany(ProductModel::class,'id_sub')
            ->select($select)
            ->whereRaw("FIND_IN_SET(?,status)", ['hienthi'])
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc');
    }
    public function getCategoryList(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ProductListModel::class,'id_list','id');
    }
    public function getCategoryCat(): \NINA\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCatModel::class,'id_cat','id');
    }
    public function getCategoryItem(): \NINA\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductItemModel::class,'id_item','id');
    }
}