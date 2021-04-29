<?php

namespace App\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use App\Exceptions\UnprocessableEntityException;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Clase base para el manejo de los modelos de invian.
 *
 * @method static array rules() Maneja las reglas de validación de cada modelo
 */
abstract class Model extends BaseModel
{
    protected $errors = [];
    protected $scenario = 'storing';

    protected $dateFormat = 'Y-m-d H:i:sO';
    protected $hidden = [
        'created_by',
        'deleted_by',
        'deleted_at',
        'modified_by',
        'updated_by',
    ];

    protected $customRules = [];
    protected $excludeRules = [];

    protected $userId;

    public function __construct(array $attributes = [])
    {
        $this->setUser(config('app.uid'));

        parent::__construct($attributes);
    }

    public function validate(): self
    {
        $validator = Validator::make(
            Arr::except(
                $this->getAttributes(),
                array_merge(
                    ['created_at', 'modified_at', 'updated_at'],
                    $this->hidden
                )
            ),
            $this->childRules()->get(true)
        );

        if ($validator->fails()) {
            throw new UnprocessableEntityException(
                trans('response.validation_fail'),
                $validator->errors()->toArray()
            );
        }

        return $this;
    }

    protected function childRules(): Rules
    {
        $rules = $this->getDeclaredRules();

        foreach ($this->customRules as $key => $rule) {
            $existsRule = array_key_exists($key, $rules);

            if ($existsRule and !in_array($key, $this->excludeRules)) {
                $rules[$key] = array_merge($rules[$key], $rule);
            }
        }

        return new Rules(Arr::except($rules, $this->excludeRules));
    }

    public function addRules(array $rules): self
    {
        $this->customRules = array_merge(
            $this->customRules,
            $rules
        );

        return $this;
    }

    private function getDeclaredRules(): array
    {
        $rules = [];

        if (method_exists(get_called_class(), 'getRules')) {
            $rules = forward_static_call([get_called_class(), 'getRules']);
        } elseif (method_exists(get_called_class(), 'rules')) {
            $rules = $this->rules();
        }

        return $rules;
    }

    public function removeRules(array $rules): self
    {
        $this->excludeRules = array_merge(
            $this->excludeRules,
            $rules
        );

        return $this;
    }

    public function getColumns()
    {
        return array_keys($this->getDeclaredRules());
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Establece el Id del usuario, este valor es usado para auditor.
     *
     * @return void
     */
    public function setUser(?int $userId)
    {
        $this->userId = to_int($userId);

        return $this;
    }

    public static function __callStatic($method, $parameters)
    {
        if ('rules' === $method) {
            return (new static())->childRules(...$parameters);
        }

        return (new static())->{$method}(...$parameters);
    }
}
