const ALERT_SUCCESS = (text)=>{
    $.toast({
        heading: 'Ação Sucedida',
        text: text,
        showHideTransition: 'slide',
        icon: 'success',
        position: 'top-center'
    });
}