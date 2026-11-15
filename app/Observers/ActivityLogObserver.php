<?php

namespace App\Observers;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogObserver
{
    private static array $changes = [];

    public function created(Model $model): void
    {
        $this->record(
            $model,
            'created',
            null,
            $this->safeValues($model->getAttributes()),
            'Menambahkan data'
        );
    }

    public function updating(Model $model): void
    {
        $old = $model->getRawOriginal();
        $new = $model->getDirty();

        $id = spl_object_id($model);

        self::$changes[$id] = [
            'old' => array_intersect_key($old, $new),
            'new' => $new,
        ];
    }

    public function updated(Model $model): void
    {
        $id = spl_object_id($model);
        $changes = self::$changes[$id] ?? null;

        unset(self::$changes[$id]);

        if (!$changes) {
            return;
        }

        $old = $this->safeValues($changes['old']);
        $new = $this->safeValues($changes['new']);

        if (empty($new)) {
            return;
        }

        $this->record(
            $model,
            'updated',
            $old,
            $new,
            'Mengedit data'
        );
    }

    public function deleted(Model $model): void
    {
        $this->record(
            $model,
            'deleted',
            $this->safeValues($model->getAttributes()),
            null,
            'Menghapus data'
        );
    }

    private function safeValues(array $values): array
    {
        unset(
            $values['password'],
            $values['remember_token']
        );

        return $values;
    }

    private function record(
        Model $model,
        string $action,
        ?array $oldValues,
        ?array $newValues,
        string $description
    ): void {
        $name = $model->getAttribute('judul')
            ?? $model->getAttribute('nama')
            ?? class_basename($model) . ' #' . $model->getKey();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'description' => $description . ': ' . $name,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => Request::ip(),
        ]);
    }
}
