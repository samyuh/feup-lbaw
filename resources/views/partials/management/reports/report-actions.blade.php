<form class="report-actions">
    <div class="input-group flex-nowrap">
        <select class="form-select report-action" 
            @if(isset($report->question_id) && $report->question_id)
                data-reported-content="{{$report->question_id}}" data-report-type="question">
            @elseif (isset($report->answer_id) && $report->answer_id) 
                data-reported-content="{{$report->answer_id}}" data-report-type="answer">
            @elseif (isset($report->comment_id) && $report->comment_id) 
                data-reported-content="{{$report->comment_id}}" data-report-type="comment">
            @else 
                data-reported-content="{{$report->reported_id}}" data-report-type="user">
            @endif
            <option selected disabled value="none">Actions</option>
            @if(isset($report->reported_id) && $report->reported_id)
                <option value="ban">Ban</option>
                <option value="ban">Delete Account</option>
            @else
                <option value="delete">Delete Content</option>
            @endif
            <option value="discard">Discard Report</option>
        </select>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check"></i>
        </button>
    </div>
</form>