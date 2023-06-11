<?php
/*
 * Copyright 2023 Cloud Creativity Limited
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace LaravelJsonApi\Laravel\Http\Controllers\Actions;

use Illuminate\Contracts\Support\Responsable;
use LaravelJsonApi\Contracts\Http\Actions\FetchOne as FetchOneContract;
use LaravelJsonApi\Contracts\Routing\Route;

trait FetchOne
{
    /**
     * Fetch zero to one JSON:API resource by id.
     *
     * @param Route $route
     * @param FetchOneContract $action
     * @return Responsable
     */
    public function show(Route $route, FetchOneContract $action): Responsable
    {
        return $action
            ->withIdOrModel($route->modelOrResourceId())
            ->withHooks($this);
    }
}
