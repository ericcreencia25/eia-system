<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    protected $table = 'project';
    use HasFactory;

    protected $fillable = [
            'ID', 'GUID', 'Purpose', 'PreviousECCNo', 'PriorTo1982', 'InNIPAS', 'ProjectName', 'MailingAddress', 'Representative', 'Designation', 'LandlineNo', 'MobileNo', 'FaxNo', 'EmailAddress', 'ZoneClassification', 'ProponentGUID', 'Address', 'Municipality', 'Province', 'Region', 'LandAreaInSqM', 'FootPrintAreaInSqM', 'Description', 'Category', 'ECALocation', 'ComponentGUID', 'ReportType', 'ProjectSize', 'Template', 'AbandonPDF', 'ComponentPDF', 'MgtPlanPDF', 'SwornPDF', 'OrderOfPayment', 'ScreeningDateStarted', 'ScreeningDateCompleted', 'ApplicationDate', 'DecisionDate', 'ReferenceNoYear', 'ReferenceNoSeries', 'ReferenceNo', 'DecisionDocument', 'DecisionDocumentScanned', 'BankBranch', 'ORNumber', 'BankTransaction', 'ProcessingFee', 'AmountPaid', 'RecommendingOfficer', 'RecommendingOfficerDesignation', 'ApprovingOfficer', 'ApprovingOfficerDesignation', 'NoOfEmployees', 'ProjectCost', 'UpdatedBy', 'UpdatedDate', 'CreatedBy', 'CreatedDate', 'TotProcDays', 'BankRefNo', 'AssociatedUser', 'AssociatedUserDate', 'AcceptedBy', 'AcceptedDate', 'ProcTimeFrameInDays', 'Basis', 'Stage'
    ];

    public function projectactivity()
    {
        return $this->hasMany(projectactivity::class, 'ProjectGUID', 'Fk_ProjectGUID');
    }
}
