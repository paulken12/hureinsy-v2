<?php

namespace App\Paf;

use Illuminate\Database\Eloquent\Model;
use App\Master\MasterProficiencyTestPaf;
use App\Master\MasterBehaviouralAssessmentPaf;
use App\Master\MasterPerformanceEvaluationPaf;
use App\Master\MasterOverallRecommendationPaf;

class PafHrAssessment extends Model
{
    protected $table = 'paf_hr_assessments';
    protected $guarded = [];
    
 	function natureOfAction() 
 	{
        return $this->belongsTo(PafManagement::class);
    }
    public function masterProficiency()
    {
        return $this->belongsTo(MasterProficiencyTestPaf::class, 'key_proficiency_test');
    } 
    public function masterBehavioural()
    {
        return $this->belongsTo(MasterBehaviouralAssessmentPaf::class, 'key_behavioural_assessment');
    } 
    public function masterEvaluation()
    {
        return $this->belongsTo(MasterPerformanceEvaluationPaf::class, 'key_performance_evaluation');
    } 
    public function masterOverall()
    {
        return $this->belongsTo(MasterOverallRecommendationPaf::class, 'key_overall_recommendation');
    } 
}