{literal}
<script type="text/javascript">

  CRM.$(function($) {

    var viewUrl = "/civicrm/contact/view?reset=1&cid=",
      similarContactsMsg;

    var checkSimilar = function() {
      // Close msg if it exists
      similarContactsMsg && similarContactsMsg.close && similarContactsMsg.close();
      
      // If there's no last name, don't perform the check
      if ($('#organization_name').val() == '') return;
      
      // Look for contacts with a matching first and last name
      CRM.api3('contact', 'get', {
        organization_name: { 'LIKE': $('#organization_name').val() + '%' },
        contact_type: 'Organization',
        'return': 'display_name,email,phone',
        'options': {
          'limit': 25, 
          'sort': 'sort_name'
        }
      }).done(function(data) {
        var title = data.count == 1 ? "Similar Organization Found" : "Similar Organization Found",
          msg = "<em>If the organization you were trying to add is listed below, click their name to view or edit their record:</em>";
        if (data.is_error == 1 || data.count == 0) {
          return;
        }
        msg += '<ul class="matching-contacts-actions">';
        $.each(data.values, function(i, contact) {
          contact.email = contact.email || '';
          contact.phone = contact.phone || '';
          msg += '<li><a href="'+viewUrl+contact.id+'">'+ contact.display_name +'</a> '+contact.phone+' '+contact.email+'</li>';
        });
        msg += '</ul>';
        similarContactsMsg = CRM.alert(msg, title);
        $('.matching-contacts-actions a').click(function() {
          // No confirmation dialog on click
          $('[data-warn-changes=true]').attr('data-warn-changes', 'false');
        });
      });
    };

    // Add the event listener for the Organization Name field
    $('#organization_name').on('change',checkSimilar);
  });
</script>
{/literal}