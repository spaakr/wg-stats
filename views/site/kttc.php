<?php
/* @var $this yii\web\View */

$this->title = 'My KTTC';
?>
<style>
    .main_stat_table {
        text-align: left;
        position: relative;
        font-size: 0;
        width: 100%;
    }

    .main_stat_table .left {
        vertical-align: top;
        width: 20%;
        position: absolute;
        left: 0;
        top: 0;
        display: inline-block;
    }

    .main_stat_table div {
        overflow: hidden;
        white-space: nowrap;
        font-size: .92rem;
        height: 1.7rem;
        border-bottom: 1px solid #DDD;
        border-right: 1px solid #DDD;
        padding: 1px 5px 0 5px;
        display: flex;
        align-items: center;
    }

    .main_stat_table .center {
        vertical-align: top;
        overflow-y: hidden;
        overflow-x: scroll;
        white-space: nowrap;
        width: 80%;
        margin-left: 20%;
        position: relative;
        display: inline-block;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .main_stat_table .center .el {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        min-width: 120px;
    }
</style>

<div class="account_content">
    <div class="main_stat_table"><span class="left">
            <div>&nbsp;</div>
            <div>Дата обновления | промежуток:</div>
            <div>Количество боёв&nbsp;<a
                    href="javascript:void(0);" id="shbd"
                    onclick="kttc.account.showShbd('shbd'); return false;">(+)</a>:</div>
            <div
                class="ats_small shbd">Побед:</div>
            <div class="ats_small shbd">Поражений:</div>
            <div
                class="ats_small shbd">Ничьи:</div>
            <div class="ats_empty"></div>
            <div id="ORE_TITLE"><span
                    class="rating_word">Рейтинг</span>&nbsp;РЭ старый:</div>
            <div id="RE_TITLE"><span
                    class="rating_word">Рейтинг</span>&nbsp;РЭ:</div>
            <div id="WN6_TITLE"><span class="rating_word">Рейтинг</span>&nbsp;WN6:</div>
            <div
                id="WN7_TITLE"><span class="rating_word">Рейтинг</span>&nbsp;WN7:</div>
            <div id="WN8_TITLE"><span
                    class="rating_word">Рейтинг</span>&nbsp;WN8:</div>
            <div id="WN8KTTC_TITLE"><span
                    class="rating_word">Рейтинг</span>&nbsp;WN8KTTC:</div>
            <div id="BRON_TITLE"><span
                    class="rating_word">Рейтинг</span>&nbsp;Броне-сайт:</div>
            <div id="XVM_TITLE"><span
                    class="rating_word">Рейтинг</span>&nbsp;XVM (WN8):</div>
            <div id="WG_TITLE"><span
                    class="rating_word">Рейтинг</span>&nbsp;WG:</div>
            <div class="ats_empty"></div>
            <div>Процент побед:</div>
            <div>Средний уровень:</div>
            <div>Средний уровень боёв:</div>
            <div
                class="ats_empty"></div>
            <div>Выстрелов за бой&nbsp;<a href="javascript:void(0);" id="sfb"
                                          onclick="kttc.account.showShbd('sfb'); return false;">(+)</a>:</div>
            <div
                class="ats_small sfb">Попаданий за бой:</div>
            <div class="ats_small sfb">Пробитий за бой:</div>
            <div
                class="ats_small sfb">Фугасов за бой:</div>
            <div>Средний урон:</div>
            <div>Ассист урон&nbsp;<a
                    href="javascript:void(0);" id="dass"
                    onclick="kttc.account.showShbd('dass'); return false;">(+)</a>:</div>
            <div
                class="ats_small dass">По засвету:</div>
            <div class="ats_small dass">Сгруппировать статистику по 1000/2000/3000/5000 боям:</div>
            <div>Вытанковано в среднем&nbsp;<a
                    href="javascript:void(0);" id="tnk"
                    onclick="kttc.account.showShbd('tnk'); return false;">(+)</a>:</div>
            <div class="ats_small tnk">Получено попаданий:</div>
            <div
                class="ats_small tnk">Получено пробитий:</div>
            <div class="ats_small tnk">Без урона:</div>
            <div
                class="ats_small tnk">Фугасов:</div>
            <div class="ats_small tnk">Заблокировано в среднем:</div>
            <div
                class="ats_small tnk">Фактор танкования:</div>
            <div>Средний опыт:</div>
            <div>Процент попаданий:</div>
            <div
                class="ats_empty"></div>
            <div>Обнаружено врагов&nbsp;(Средний):</div>
            <div>Обнаружено врагов&nbsp;(Всего):</div>
            <div>Уничтожено врагов&nbsp;(Средний):</div>
            <div>Уничтожено врагов&nbsp;(Всего):</div>
            <div>Захват базы:</div>
            <div>Защита базы:</div>
            <div>Выжил в битвах:</div>
            <div>Уничтожено / уничтожен:</div>
            <div>Максимальный опыт за бой:</div>
            <div>Максимум урон за бой:</div>
            <div>Среднее кол-во боев в день:</div></span><span
            class="center">
            <span class="el">
                <div>Общий</div>
                <div><small>01.03.17 05:40</small></div>
                <div><span style="color: #25c2dd;">29 156</span></div>
                <div class="ats_small shbd">17044</div>
                <div class="ats_small shbd">11741</div>
                <div class="ats_small shbd">371</div>
                <div class="ats_empty"></div>
                <div id="ORE_PARAMS" class="ORE_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 1805 (+296.83)">1 508.17</span>
                </div>
                <div id="RE_PARAMS" class="RE_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 1880 (+332.28)">1 547.72</span>
                </div>
                <div id="WN6_PARAMS" class="WN6_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 1990 (+334.69)">1 655.31</span>
                </div>
                <div id="WN7_PARAMS" class="WN7_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 1995 (+339.69)">1 655.31</span>
                </div>
                <div id="WN8_PARAMS" class="WN8_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 2880 (+605.88)">2 274.12</span>
                </div>
                <div id="WN8KTTC_PARAMS" class="WN8KTTC_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 2880 (+372.97)">2 507.03</span>
                </div>
                <div id="BRON_PARAMS" class="BRON_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 9600 (+1857.75)">7 742.25</span>
                </div>
                <div id="XVM_PARAMS" class="XVM_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 93 (+14.58)">78.42</span>
                </div>
                <div id="WG_PARAMS" class="WG_PARAMS" style="color: #25c2dd;">
                    <span title="Следующая ступень начинается с 10175 (+536.00)">9 639.00</span>
                </div>
                <div class="ats_empty"></div>
                <div style="color: #25c2dd;">58.46%</div>
                <div style="color: #25c2dd;">8.04</div>
                <div style="color: #c64cff;">9.06</div>
                <div class="ats_empty"></div>
                <div>10.57</div>
                <div class="ats_small sfb">7.72</div>
                <div class="ats_small sfb">4.16</div>
                <div class="ats_small sfb">0.03</div>
                <div
                    style="color: #4A9C02;">1 619</div>
                <div>671.58</div>
                <div class="ats_small dass">545.52</div>
                <div
                    class="ats_small dass">126.06</div>
                <div>1 123</div>
                <div class="ats_small tnk">3.24</div>
                <div class="ats_small tnk">2.34</div>
                <div class="ats_small tnk">0.9</div>
                <div class="ats_small tnk">0.15</div>
                <div class="ats_small tnk">402.54</div>
                <div class="ats_small tnk">0.34</div>
                <div>739</div>
                <div style="color: #4A9C02;">73</div>
                <div class="ats_empty"></div>
                <div style="color: #25c2dd;">1.51</div>
                <div>43 992</div>
                <div style="color: #25c2dd;">1.25</div>
                <div>36 405</div>
                <div>1.23</div>
                <div>1.07</div>
                <div>36.08%</div>
                <div>1.95</div>
                <div>3 063 (ИС-6)</div>
                <div>9 538 (AMX 50 Foch (155))</div>
                <div>18</div></span>
        </span>
    </div>

    <div class="wreplays"><img src="/images/wotreplays_logo.png">&nbsp;<a id="wrurl"
                                                                          href="http://wotreplays.ru/site/index/version/49,48,45/player/Kalessin/sort/uploaded_at.desc"
                                                                          target="_blank">Реплеи Kalessin на WoTReplays
            (9 штук)</a></div>
</div>
