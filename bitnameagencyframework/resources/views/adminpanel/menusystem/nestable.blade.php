<h5 class="hk-sec-title">{{ $nestable_title }}</h5>
	{{ $nestableRender }}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function()
{

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#{{ $nestableID }}').nestable({
        group: 1,
		maxDepth: 3
    })
    .on('change', updateOutput);

 

    // output initial serialised data
    updateOutput($('#{{ $nestableID }}').data('output', $('#{{ $nestableID }}-output')));

    $('#{{ $nestableID }}-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        }
    });

   

});
</script>
	<form method="POST">
	 <textarea style="display:none;" name="menuDesign" style="width:30%;" id="{{ $nestableID }}-output"></textarea>
	 <button class="btn btn-success float-right">
	 {{ $nestableUpdate_button }}
	 </button>
	 @csrf
	 </form>