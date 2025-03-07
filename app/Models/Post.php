<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with=[
        'category',
        'tags',
        ];

    public function getRouteKeyName() : String
    {
        return 'slug';
    }

    public function scopeFilters(Builder $query, array $filters): void
    {
        if(isset($filters['search'])){
            $query->where(fn (Builder $query) => $query
            ->where('title', 'LIKE', '%'. $filters['search'] . '%')
            ->orWhere('content', 'LIKE', '%'. $filters['search'] . '%')
        );
        }

        if(isset($filters['category'])){
            $query->where(
                'category_id', $filters['category']->id ?? $filters['category']
            );
        }

        if(isset($filters['tag'])){
            $query->whereRelation(
                'tags', 'tags.id', $filters['tag']->id ?? $filters['tag']
            );
        }

        if(isset($filters['sortBy'])){

            $query->orderBy($filters['sortBy'], 'desc');
        }
    }

    public function exists(): bool
    {
        return (bool) $this->id;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function perc(int $s) : array #une méthode qui calcul et retourne le pourcentage des avis en fonction de chaque en prenant l'étoile en paramètre
    {
        $infoRat = [];
        if($nbRats = $this->ratings()->count()){
            switch ($s){
                case '5' : $p = ($this->ratings()->where('stars_rated', '5')->count()*100)/$nbRats;
                break;

                case '4' : $p = ($this->ratings()->where('stars_rated', '4')->count()*100)/$nbRats;
                break;

                case '3' : $p = ($this->ratings()->where('stars_rated', '3')->count()*100)/$nbRats;
                break;

                case '2' : $p = ($this->ratings()->where('stars_rated', '2')->count()*100)/$nbRats;
                break;

                case '1' : $p = ($this->ratings()->where('stars_rated', '1')->count()*100)/$nbRats;
                break;

                case '0' : $p = ($this->ratings()->where('stars_rated', '0')->count()*100)/$nbRats;
                break;
            }
            return $infoRat[] = [
                'total' => $this->ratings()->where('stars_rated', $s)->count(), //total des avis avec la note $s
                'pourcentage' => round($p, 1) , //pourcentage des avis avec la note $s en l'arrondissant d'un chiffre après la virgule
            ];
        }
        else return $infoRat[] = [
            'total' => 0,
            'pourcentage' => 0 ,
        ];
    }
     public function viewed() {
        $sessionKey = "is_post_($this->id)_viewed";
        if(!session()->get($sessionKey)){
            self::withoutTimestamps(function(){
                $this->increment('view_count');
            });
             session()->put($sessionKey, true);
             session()->save();

        }

    }
}
