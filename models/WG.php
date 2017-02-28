<?php
/**
 * Created by PhpStorm.
 * User: krm
 * Date: 27.02.2017
 * Time: 20:28
 */

namespace app\models;


use yii\base\Object;
use yii\helpers\ArrayHelper;

class WG
{
    public $account_id = 8800265;

    public function getAccountInfo()
    {
        return json_decode(file_get_contents('https://api.worldoftanks.ru/wot/account/info/?application_id=demo&fields=statistics.all&account_id=' . $this->account_id));
    }

    public function getAccountStats()
    {
        return json_decode(file_get_contents('https://api.worldoftanks.ru/wot/tanks/stats/?application_id=demo&fields=tank_id,all&account_id=' . $this->account_id));
    }

    public function getTanksWithTiers()
    {

        $jsonTanks = json_decode(file_get_contents(\Yii::getAlias('@app/web/files/tanks.json')));
        $tanksWithTiers = \yii\helpers\ArrayHelper::map($jsonTanks->data, 'tank_id', 'tier');

        return $tanksWithTiers;

        $file = file_get_contents('https://api.worldoftanks.ru/wot/encyclopedia/vehicles/?application_id=demo');
        file_put_contents(\Yii::getAlias('@app/web/files/tanks.json'), $file);
    }

    public function getExpTankValues()
    {
        $expValues = file_get_contents(\Yii::getAlias('@app/web/files/expected_tank_values_latest.json'));
        return json_decode($expValues);
        $expValues = file_get_contents('http://www.wnefficiency.net/exp/expected_tank_values_latest.json');
        $expValues = file_get_contents('http://stat.modxvm.com/wn8.json');
        file_put_contents(\Yii::getAlias('@app/web/files/expected_tank_values_latest.json'), $expValues);
    }

    public function getAccountTier()
    {
        $account_id = $this->account_id;
        $info = $this->getTanksWithTiers();
        //объявление временных переменных
        $sumbat = 0;// сумма кол-во боев, для расчета ср. ур. проведенных боев
        $sumbatlvl = 0;// сумма "текущий lvl-танка" * кол-во боев на танке, для расчета ср. ур. проведенных боев
        //проверка наличия входных данных
        $accountStats = $this->getAccountStats();
        if ($accountStats && isset($accountStats, $accountStats->data, $accountStats->data->$account_id)) {

            // в цикле по второму ответу $out_2 - по всем танкам игрока
            foreach ($accountStats->data->$account_id as $key => $value) {

                //присвоение переменной текущего id-танка
                $tank_id = $value->tank_id;

                // проверка наличия свойств статистики текущего танка, количество боев и наличия танка в ВАШем инфо-массиве (защищает от ошибок если в стате игрока есть данные "левых" танков (удаленных, тестовых и т.д.))
                if (isset($value->all, $value->all->battles, $info[$tank_id]) && $value->all->battles > 0) {
                    //добавление к сумме данных текущего танка (боев и произведения боев на уровень)
                    $sumbat += $value->all->battles;
                    $sumbatlvl += $value->all->battles * $info[$tank_id];
                };
            };
        };
        //подсчет "ср. уровня проведенных боев"
        if ($sumbat > 0) {
            $TIER = $sumbatlvl / $sumbat;
        };
        //Запись TIER в первый ответ (если ВАМ надо)
        return isset($TIER) ? $TIER : 0;
        // удаление временных переменных
        unset($sumbat, $sumbatlvl, $accountStats, $TIER);
    }

    public function getEff()
    {
        //!!! переменная id-акка игрока (задана ранее, перед запросами)
        $account_id = $this->account_id;
        $accountInfo = $this->getAccountInfo();
        //проверка наличия входных данных и количества боев
        if ($accountInfo && isset($accountInfo, $accountInfo->data, $accountInfo->data->$account_id, $accountInfo->data->$account_id->statistics, $accountInfo->data->$account_id->statistics->all, $accountInfo->data->$account_id->statistics->all->battles) && $accountInfo->data->$account_id->statistics->all->battles > 0) {

            //временная переменная кол-ва боев
            $battles = $accountInfo->data->$account_id->statistics->all->battles;
            //временный массив входных данных - общей статистики игрока
            $effmas = [];
            //заполнение массива:
            //DAMAGE - "Нанесено повреждений за бой"
            $effmas['DAMAGE'] = $accountInfo->data->$account_id->statistics->all->damage_dealt / $battles;
            //TIER - "ср. уровень проведенных боев" (Ранее рассчитанный! и сохраненный в том же массиве статы игрока)
            $effmas['TIER'] = $this->getAccountTier();
            //FRAGS - "ср.уничтожено за бой"
            $effmas['FRAGS'] = $accountInfo->data->$account_id->statistics->all->frags / $battles;
            //SPOT - "ср. за бой Обнаружено противников"
            $effmas['SPOT'] = $accountInfo->data->$account_id->statistics->all->spotted / $battles;
            //CAP - "ср. за бой Очков захвата базы"
            $effmas['CAP'] = $accountInfo->data->$account_id->statistics->all->capture_points / $battles;
            //DEF - "ср. за бой Очков защиты базы"
            $effmas['DEF'] = $accountInfo->data->$account_id->statistics->all->dropped_capture_points / $battles;
            //рассчет РЭ
            $EFF = $effmas['DAMAGE'] * (10 / ($effmas['TIER'] + 2)) * (0.23 + 2 * $effmas['TIER'] / 100) + $effmas['FRAGS'] * 250 + $effmas['SPOT'] * 150 + (log($effmas['CAP'] + 1) / log(1.732)) * 150 + $effmas['DEF'] * 150;

            //удаление временных переменных
            unset($effmas, $battles, $accountInfo);

            //округление результата, если Вам это надо (я округляю перед выводом на экран)

            //вывод результата - $EFF
            return ($EFF);
        }
    }

    public function getWN8()
    {
        $accountStats = $this->getAccountStats();
        $expValues = $this->getExpTankValues();
        $tank_ids = ArrayHelper::map($expValues->data, 'IDNum', 'IDNum');
        $newExpValues = array_combine($tank_ids, $expValues->data);
        $account_id = $this->account_id;

        $avgDmg = null;
        $avgSpot = null;
        $avgFrag = null;
        $avgDef = null;
        $avgWinRate = null;
        $avgWinRate2 = null;

        $expDmg = null;
        $expSpot = null;
        $expFrag = null;
        $expDef = null;
        $expWinRate = null;

        $rDAMAGE = null;
        $rSPOT = null;
        $rFRAG = null;
        $rDEF = null;
        $rWIN = null;

        foreach ($accountStats->data->$account_id as $tankInfo) {
            $data = $tankInfo->all;
            $tank_id = $tankInfo->tank_id;

            if (isset($newExpValues[$tank_id])) {
                $avgDmg += $data->damage_dealt;
                $avgSpot += $data->spotted;
                $avgFrag += $data->frags;
                $avgDef += $data->dropped_capture_points;
                $avgWinRate += $data->wins;

                $expDmg += ($data->battles * $newExpValues[$tank_id]->expDamage);
                $expSpot += ($data->battles * $newExpValues[$tank_id]->expSpot);
                $expFrag += ($data->battles * $newExpValues[$tank_id]->expFrag);
                $expDef += ($data->battles * $newExpValues[$tank_id]->expDef);
                $expWinRate += ($data->battles * ($newExpValues[$tank_id]->expWinRate));
            }
        }

        $rDAMAGE = $avgDmg / ($expDmg);
        $rSPOT = $avgSpot / ($expSpot);
        $rFRAG = $avgFrag / ($expFrag);
        $rDEF = $avgDef / ($expDef);
        $rWIN = $avgWinRate / ($expWinRate / 100);

        $rWINc = max(0, ($rWIN - 0.71) / (1 - 0.71));
        $rDAMAGEc = max(0, ($rDAMAGE - 0.22) / (1 - 0.22));
        $rFRAGc = max(0, min($rDAMAGEc + 0.2, ($rFRAG - 0.12) / (1 - 0.12)));
        $rSPOTc = max(0, min($rDAMAGEc + 0.1, ($rSPOT - 0.38) / (1 - 0.38)));
        $rDEFc = max(0, min($rDAMAGEc + 0.1, ($rDEF - 0.10) / (1 - 0.10)));
        $WN8 = 980 * $rDAMAGEc + 210 * $rDAMAGEc * $rFRAGc + 155 * $rFRAGc * $rSPOTc + 75 * $rDEFc * $rFRAGc + 145 * MIN(1.8, $rWINc);
        return $WN8;
    }
}