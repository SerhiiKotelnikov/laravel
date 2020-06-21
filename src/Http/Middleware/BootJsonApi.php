<?php
/**
 * Copyright 2020 Cloud Creativity Limited
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

namespace LaravelJsonApi\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use LaravelJsonApi\Http\Server;

class BootJsonApi
{

    /**
     * Handle the request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $name
     * @return mixed
     */
    public function handle($request, Closure $next, string $name)
    {
        app()->instance(Server::class, new Server($name));

        $this->bindPageResolver();

        return $next($request);
    }

    /**
     * Override the page resolver to read the page parameter from the JSON API request.
     *
     * @return void
     */
    protected function bindPageResolver(): void
    {
        /** Override the current page resolution */
        AbstractPaginator::currentPageResolver(function ($pageName) {
            $pagination = \request()->query($pageName);

            return $pagination['number'] ?? null;
        });
    }
}