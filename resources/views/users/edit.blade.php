@extends('layouts.app')

@section('content')
    <!--@php-->
    <!--    dd($user->self_information);-->
    <!--@endphp-->
    <h3 class="offset-3 offset-lg-4 col-6 col-lg-4 shadow-sm py-3 my-5 rounded-pill text-center">
    プロフィール編集
    </h3>
   
   <div class="row bg-white py-3">
        <div class="col-12">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'files' => true, 'method' => 'put']) !!}
                <div class="form-group">
                    <div>{!! Form::label('name', '名前') !!}</div>
                    <div class="mb-3">{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}</div>
                    
                    <div>{!! Form::label('gender', '性別') !!}</div>
                    <div class="mb-3">
                        
                        <label class="radio-button mr-3">
                            {{ Form::radio('gender', '1', (old('gender')== '1' ? true: ($user->gender == '1'))? true:false, ['class' => 'form-control']) }}
                            <span class="radio-button__icon">男性</span>
                        </label>
                        <label class="radio-button mr-3">
                            {{ Form::radio('gender', '2',  (old('gender')== '2' ? true: ($user->gender == '2'))? true:false, ['class' => 'form-control']) }}
                            <span class="radio-button__icon">女性</span>
                        </label>
                        <label class="radio-button">
                            {{ Form::radio('gender', '0', (old('gender')== '0' ? true: ($user->gender == '0'))? true:false, ['class' => 'form-control p-5']) }}
                            <span class="radio-button__icon">未回答</span>
                        </label>
                    </div>
                    
                    <div>{!! Form::label('year', '生年月日') !!}</div>
                    <div class="d-flex">
                        <div class="mb-3 mr-1">{{Form::select('year', 
                        [
                        null => 'xxxx', 
                        '1922' => '1922', 
                        '1923' => '1923', 
                        '1924' => '1924', 
                        '1925' => '1925', 
                        '1926' => '1926', 
                        '1927' => '1927', 
                        '1928' => '1928', 
                        '1929' => '1929', 
                        '1930' => '1930', 
                        '1931' => '1931', 
                        '1932' => '1932', 
                        '1933' => '1933', 
                        '1934' => '1934', 
                        '1935' => '1935', 
                        '1936' => '1936', 
                        '1937' => '1937', 
                        '1938' => '1938', 
                        '1939' => '1939', 
                        '1940' => '1940', 
                        '1941' => '1941', 
                        '1942' => '1942', 
                        '1943' => '1943', 
                        '1944' => '1944', 
                        '1945' => '1945', 
                        '1946' => '1946', 
                        '1947' => '1947', 
                        '1948' => '1948', 
                        '1949' => '1949', 
                        '1950' => '1950', 
                        '1951' => '1951', 
                        '1952' => '1952', 
                        '1953' => '1953', 
                        '1954' => '1954', 
                        '1955' => '1955', 
                        '1956' => '1956', 
                        '1957' => '1957', 
                        '1958' => '1958', 
                        '1959' => '1959', 
                        '1960' => '1960', 
                        '1961' => '1961', 
                        '1962' => '1962', 
                        '1963' => '1963', 
                        '1964' => '1964', 
                        '1965' => '1965', 
                        '1966' => '1966', 
                        '1967' => '1967', 
                        '1968' => '1968', 
                        '1969' => '1969', 
                        '1970' => '1970', 
                        '1971' => '1971', 
                        '1972' => '1972', 
                        '1973' => '1973', 
                        '1974' => '1974', 
                        '1975' => '1975', 
                        '1976' => '1976', 
                        '1977' => '1977', 
                        '1978' => '1978', 
                        '1979' => '1979', 
                        '1980' => '1980', 
                        '1981' => '1981', 
                        '1982' => '1982', 
                        '1983' => '1983', 
                        '1984' => '1984', 
                        '1985' => '1985', 
                        '1986' => '1986', 
                        '1987' => '1987', 
                        '1988' => '1988', 
                        '1989' => '1989', 
                        '1990' => '1990', 
                        '1991' => '1991', 
                        '1992' => '1992', 
                        '1993' => '1993', 
                        '1994' => '1994', 
                        '1995' => '1995', 
                        '1996' => '1996', 
                        '1997' => '1997', 
                        '1998' => '1998', 
                        '1999' => '1999', 
                        '2000' => '2000', 
                        '2001' => '2001', 
                        '2002' => '2002', 
                        '2003' => '2003', 
                        '2004' => '2004', 
                        '2005' => '2005', 
                        '2006' => '2006', 
                        '2007' => '2007', 
                        '2008' => '2008', 
                        '2009' => '2009', 
                        '2010' => '2010', 
                        '2011' => '2011', 
                        '2012' => '2012', 
                        '2013' => '2013', 
                        '2014' => '2014', 
                        '2015' => '2015', 
                        '2016' => '2016', 
                        '2017' => '2017', 
                        '2018' => '2018', 
                        '2019' => '2019', 
                        '2020' => '2020', 
                        '2021' => '2021', 
                        '2022' => '2022'], $user->year, ['class' => 'form-control'])}}</div>
                        <div class="d-flex align-items-center mr-3 mb-3">年</div>
                        
                        
                        <div class="mb-3 mr-1">{{Form::select('month', 
                        [null => 'xx', 
                        '1' => '1',
                        '2' => '2', 
                        '2' => '2', 
                        '3' => '3', 
                        '4' => '4', 
                        '5' => '5', 
                        '6' => '6', 
                        '7' => '7', 
                        '8' => '8', 
                        '9' => '9', 
                        '10' => '10', 
                        '11' => '11', 
                        '12' => '12'], $user->month, ['class' => 'form-control'])}}</div>
                        <div class="d-flex align-items-center mr-3 mb-3">月</div>
                        
                        
                        
                        <div class="mb-3 mr-1">{{Form::select('day', 
                        [null => 'xx', 
                        '1' => '1',
                        '2' => '2', 
                        '3' => '3', 
                        '4' => '4', 
                        '5' => '5', 
                        '6' => '6', 
                        '7' => '7', 
                        '8' => '8', 
                        '9' => '9', 
                        '10' => '10', 
                        '11' => '11', 
                        '12' => '12', 
                        '13' => '13', 
                        '14' => '14', 
                        '15' => '15', 
                        '16' => '16', 
                        '17' => '17', 
                        '18' => '18', 
                        '19' => '19', 
                        '20' => '20', 
                        '21' => '21', 
                        '22' => '22', 
                        '23' => '23', 
                        '24' => '24', 
                        '25' => '25', 
                        '26' => '26', 
                        '27' => '27', 
                        '28' => '28', 
                        '29' => '29', 
                        '30' => '30', 
                        '31' => '31'], $user->day, ['class' => 'form-control'])}}</div>
                        <div class="d-flex align-items-center mr-3 mb-3">日</div>
                    </div>
                    
                    <div class="mt-3 mb-2">SNS</div>
                    <div>{!! Form::label('Twitter', 'Twitter') !!}</div>
                    <div class="mb-3">{!! Form::text('Twitter', $user->Twitter, ['class' => 'form-control']) !!}</div>
                    
                    <div>{!! Form::label('Instagram', 'Instagram') !!}</div>
                    <div class="mb-3">{!! Form::text('Instagram', $user->Instagram, ['class' => 'form-control']) !!}</div>
                    
                    <div>{!! Form::label('Facebook', 'Facebook') !!}</div>
                    <div class="mb-3">{!! Form::text('Facebook', $user->Facebook, ['class' => 'form-control']) !!}</div>
                    
                    
                    
                    <div class="mt-5">{!! Form::label('self_information', '自己紹介') !!}</div>
                    <div class="mb-3">{!! Form::textarea('self_information', $user->self_information, ['class' => 'form-control']) !!}</div>
                    <div>{!! Form::label('icon', 'アイコン画像') !!}</div>
                    <div class="mb-3">{!! Form::file('icon', ['class'=>'form-controll']) !!}</div>
                </div>
                <div class="text-center">{!! Form::submit('プロフィールを更新', ['class' => 'btn btn-primary']) !!}</div>

            {!! Form::close() !!}
            
            
        </div>
    </div>
    
    
@endsection