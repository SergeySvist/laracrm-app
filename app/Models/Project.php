<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $type
 * @property string|null $description
 * @property string $contacts
 * @property int $avatar_file_id
 * @property int $ts_file_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read File|null $avatarFile
 * @property-read File|null $tsFile
 * @method static ProjectFactory factory($count = null, $state = [])
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @method static Builder|Project whereAvatarFileId($value)
 * @method static Builder|Project whereContacts($value)
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereDescription($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereTsFileId($value)
 * @method static Builder|Project whereType($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'description', 'contacts',
    ];

    protected $hidden = [
        'avatar_file_id', 'ts_file_id',
        'created_at', 'updated_at',
    ];

    public function avatarFile(){
        return $this->hasOne(File::class, 'id', 'avatar_file_id');
    }

    public function tsFile(){
        return $this->hasOne(File::class, 'id', 'ts_file_id');
    }
}
