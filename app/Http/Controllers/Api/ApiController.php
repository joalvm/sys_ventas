<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Contracts\RepositoryContract;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function callAction($method, $parameters)
    {
        foreach ($this->getProperties() as $property) {
            if ($this->{$property} instanceof RepositoryContract) {
                /** @var RepositoryContract $repository */
                $repository = $this->{$property};

                $repository->setUserFromConfig();
            }
        }

        return parent::callAction($method, $parameters);
    }

    private function getProperties(): array
    {
        return array_keys(
            array_diff_key(
                get_class_vars(get_called_class()),
                get_class_vars(__CLASS__)
            )
        );
    }
}
