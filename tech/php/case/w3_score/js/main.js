$(function(){
    
    //保存查询记录，饼图用
    var pie_s;
    
    /*
     * 获取成绩   页面加载  切换 科目时调用
     * @argum require   int  科目id   1:数学    2：语文    3：英语    4：物理  
     * */
    function getScore(require){
        $.get('doAction.php?a=show&s='+require,function(data){
            //$(document.body).append(data);
            data=pie_s=JSON.parse(data);  //pie_s同时赋值
            
            var html='';
            for(var i=0; i<data.length; i++){
                
                html+='<tr>'+
                    '<td>'+data[i].name+'</td>'+
                    '<td onselectstart="return false;"  class="score_td"><span>'+(data[i].score==null? '0':data[i].score)+'</span> <input type="text"> <a class="okBtn" data-id="'+data[i].id+'" href="###">确定</a> <a class="cancelBtn" href="###">取消</a></td>'+
                '</tr>';
            }
            $('#scoreTable tbody').empty().append(html);
            //console.log(pie_s);
            set_pie();
        })
        
        
    }
    
    /*保存edit数据    每次修改成绩后调用
     * @argum okBtn   obj  保存按钮     该按钮身上有data-id属性，保存着记录的id
     * */
    
    //
    function save(okBtn){
        var id=okBtn.attr('data-id'); //id
        var course=$('#sel').val(); //科目
        var score=okBtn.siblings('input').val(); //成绩
        $.get('doAction.php?a=update&id='+id+"&c="+course+"&s="+score,function(data){
            //$(document.body).append(data);
            if(data){
                okBtn.siblings('span').text(score);
                //放在这里,隐藏效果完美
                okBtn.parent().removeClass('edit');
            }
        });
    }
    
    //--------------------------------------------
    
    //页面加载      默认显示数学（id=1）成绩     
    getScore(1);
    
    
    
    //切换成绩
    $('#sel').change(function(){
        getScore( $(this).val() );
    });
    
    
    //编辑
    $('table').on('dblclick','.score_td',function(){
        var _this=$(this);
        //只有本条记录处于编辑状态
        $('.edit').removeClass('edit');
        _this.addClass('edit');
        
        txt=_this.children('span').text();
        _this.children('input').focus().val(txt);
    });
    
    
    
    //点击okBtn保存数据
    $('table').on('click','.okBtn',function(){
        save($(this));
    });
    
    $('table').on('click','.cancelBtn',function(){
        $(this).parent().removeClass('edit');
    });
    
    
    //确定键触发okBtn  esc 触发cancelBtn
    $(document).keydown(function(ev){
        switch(ev.which){
            case 13:
                //当前编辑状态
                save($('.edit .okBtn'));
            break;
            
            case 27:
                $('.edit .cancelBtn').trigger('click');
            break;
        }
    });
    
    //刷新饼图
    $("#refresh").click(function(){
        var course=$('#sel').val(); //科目
        $.get('doAction.php?a=show&s='+course,function(data){
            pie_s=JSON.parse(data);  //pie_s同时赋值
            set_pie();
        })
    });
    
    
    //----------------------------------------------------
    //饼图
    function set_pie(){
       //定义分数段
        var s90_100=s80_90=s70_80=s60_70=s60=0;
        
        for(var i=0; i<pie_s.length; i++){
            if(pie_s[i]["score"]>=90){
                s90_100++;
            }else if(pie_s[i]["score"]>=80 && pie_s[i]["score"]<90){
                s80_90++;
            }else if(pie_s[i]["score"]>=70 && pie_s[i]["score"]<80){
                s70_80++;
            }else if(pie_s[i]["score"]>=60 && pie_s[i]["score"]<70){
                s60_70++;
            }else{
                s60++;
            }
        }
        
        var option = {
            tooltip: {
                trigger: 'item',
                formatter: "{a} <br/>{b}: {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',//horizontal
                x: 'left',
                data:['90--100分','80--90分','70--80分','60--70分','60分以下']
            },
            series: [
                {
                    name:'访问来源',
                    type:'pie',
                    radius: ['50%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        normal: {
                            show: false,
                            position: 'center',
                        },
                        emphasis: {
                            show: true,
                            textStyle: {
                                fontSize: '30',
                                fontWeight: 'bold'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            show: false
                        }
                    },
                    center:["60%","50%"],
                    data:[
                        {value:s90_100, name:'90--100分'},
                        {value:s80_90, name:'80--90分'},
                        {value:s70_80, name:'70--80分'},
                        {value:s60_70, name:'60--70分'},
                        {value:s60, name:'60分以下'}
                    ]
                }
            ]
        };
    
        var myChart = echarts.init(document.getElementById('pie'));
        myChart.setOption(option);
    }
    
    
    
    
    
    
})