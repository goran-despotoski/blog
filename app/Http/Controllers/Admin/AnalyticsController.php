<?php

namespace App\Http\Controllers\Admin;

use App\DataTransferObjects\AnalyticDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnalyticRequest;
use App\Http\Requests\UpdateAnalyticRequest;
use App\Models\Analytic;
use App\Services\AnalyticService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function __construct(
        private AnalyticService $analyticsService
    )
    {
    }

    public function index()
    {
        $analytics = $this->analyticsService->getAnalyticsByTeamId(config('app.current_team_id'));

        return view('admin.blog.analytics.index', ['analytics' => $analytics]);
    }

    public function create()
    {
        return view('admin.blog.analytics.create');
    }

    public function store(StoreAnalyticRequest $request)
    {
        $analyticDTO = AnalyticDTO::fromArray($request->all());
        $analyticDTO->team_id = config('app.current_team_id');

        $this->analyticsService->store($analyticDTO);

        return redirect()->route('admin.analytics.index', ['status' => 'created_success']);
    }

    public function edit(Analytic $analytic)
    {
        return view('admin.blog.analytics.edit', ['analytic' => $analytic]);
    }

    public function update(UpdateAnalyticRequest $request, Analytic $analytic)
    {
        $analyticDTO = AnalyticDTO::fromArray($request->all());
        $analyticDTO->team_id = config('app.current_team_id');

        $this->analyticsService->update($analytic, $analyticDTO);

        return redirect()->route('admin.analytics.index', ['status' => 'updated_success']);
    }

    public function delete(Analytic $analytic)
    {
        return view('admin.blog.analytics.delete', ['analytic' => $analytic]);
    }

    public function destroy(Analytic $analytic)
    {
        $this->analyticsService->destroy($analytic);

        return redirect()->route('admin.analytics.index', ['status' => 'deleted_success']);
    }
}
