        $('#publication-select').on('change', function() {
          if ( this.value == '1')
          {
            $("#list-journal").show();
            $("#list-proceeding").hide();
            $("#list-particle").hide();
            $("#list-poster").hide();
          }else if(this.value == '2'){
            $("#list-journal").hide();
            $("#list-proceeding").show();
            $("#list-particle").hide();
            $("#list-poster").hide();
          }else if(this.value == '3'){
            $("#list-journal").hide();
            $("#list-proceeding").hide();
            $("#list-particle").show();
            $("#list-poster").hide();
          }else if(this.value == '4'){
            $("#list-journal").hide();
            $("#list-proceeding").hide();
            $("#list-particle").hide();
            $("#list-poster").show();
          }
        });