<?php

namespace App\View\Components;

use App\Services\AnalyticService;
use Illuminate\View\Component;
use Illuminate\View\View;

class PublicLayout extends Component
{
    public function __construct(
        private AnalyticService $analyticService
    )
    {
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $analytics = $this->analyticService->getAnalyticsByTeamId(config('app.current_team_id'));
        return view('layouts.public', ['analytics' => $analytics]);
    }
}
