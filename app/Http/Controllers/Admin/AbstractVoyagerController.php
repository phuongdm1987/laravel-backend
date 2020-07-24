<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Henry\Domain\Voyager\VoyagerEditor;
use Henry\Domain\Voyager\VoyagerReader;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

/**
 * Class AbstractVoyagerController
 * @package App\Http\Controllers\Admin
 */
abstract class AbstractVoyagerController extends VoyagerBaseController
{
    /**
     * @param Request $request
     * @return VoyagerEditor
     * @throws AuthorizationException
     */
    protected function getEditInfo(Request $request, $id): VoyagerEditor
    {
        [$slug, $dataType, $dataTypeContent] = $this->getCommonInfo($request, $id);

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'edit', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        $voyagerEditor = new VoyagerEditor($view);
        $voyagerEditor->setDataType($dataType);
        $voyagerEditor->setDataTypeContent($dataTypeContent);
        $voyagerEditor->setIsModelTranslatable($isModelTranslatable);

        return $voyagerEditor;
    }

    /**
     * @param Request $request
     * @return VoyagerReader
     * @throws AuthorizationException
     */
    protected function getReadInfo(Request $request, $id): VoyagerReader
    {
        [$slug, $dataType, $dataTypeContent, $isSoftDeleted] = $this->getCommonInfo($request, $id);

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'read', $isModelTranslatable);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        $voyagerReader = new VoyagerReader($view);
        $voyagerReader->setDataType($dataType);
        $voyagerReader->setDataTypeContent($dataTypeContent);
        $voyagerReader->setIsModelTranslatable($isModelTranslatable);
        $voyagerReader->setIsSoftDeleted($isSoftDeleted);

        return $voyagerReader;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    private function getCommonInfo(Request $request, $id): array
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        return [$slug, $dataType, $dataTypeContent, $isSoftDeleted];
    }
}
