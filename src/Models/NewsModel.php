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


class NewsModel extends Model
{
    use HasFactory,TraitAttr;
    protected $guarded = [];
    protected $table = 'news';

    public function getMember()
    {
        if(empty($this->member_list)) return collect([]);
        $memberList = explode(',',$this->member_list );
        
        return MemberModel::select('*')
            ->whereRaw("FIND_IN_SET(?,status)", [ 'hienthi' ])
            ->whereIn("id", $memberList)
            ->orderBy('numb', 'asc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getCategoryList(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(NewsListModel::class,'id_list','id');
    }
    public function getCategoryCat(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(NewsCatModel::class,'id_cat','id');
    }
    public function getCategoryItem(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(NewsItemModel::class,'id_item','id');
    }
    public function getCategorySub(): \NINA\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(NewsSubModel::class,'id_sub','id');
    }
    public function tags(): \NINA\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TagsModel::class, 'news_tags', 'id_parent', 'id_tags');
    }
}
