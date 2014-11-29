<script language="javascript" type="text/javascript">

var pdfViewUpdate = function(resumeURL) {
    // change pdf path for pdfViewModal
}

var updateJob = function(jobId, jobTitle) {
    $("#myModalJobTitleLabel").html(jobTitle);
    
    var url = <?php echo json_encode(URL); ?>;
    var post_url = url + 'board/ajax_getJobById/' + jobId;
            
    $.ajax({
        url: post_url,
        type: 'post',
        data: 'json',
        success: function(jsonData) {
            var data = JSON.parse(jsonData);
            var content='<table id="student-container"><tbody id="student-body">\n';
            data.forEach(function(element, index, array) {
                content += '<tr>\n';
                content += '<td>' + element.firstname + ' ' + element.lastname + '</td>\n';
                content += '<td>' + element.email + '</td>\n';
                if(element.personalLink) content += '<td><a href="' + element.personalLink + '" target="_blank">Personal Link</td>\n';
                content += '<td>' + element.phoneNumber + '</td>\n';
                content += '<td>' + element.school + '</td>\n';
                if(element.resume) content += '<td><a class="student-name" data-toggle="modal" data-target="#pdfViewModal" onclick="pdfViewUpdate(\'' + element.resume + '\')">Resume</a></td>\n';
                content += '</tr>\n';
            });
            content += '</tbody></table>';
            $("#jobModalBody").html(content);
        }
    });
};

</script>