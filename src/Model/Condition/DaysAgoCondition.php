<?php

namespace SilverStripers\ScheduledMessages\Model\Condition;

use SilverStripe\Core\Convert;
use SilverStripe\ORM\FieldType\DBDatetime;

class DaysAgoCondition extends Condition
{

    private static $table_name = 'DaysAgoCondition';

    public function getType()
    {
        return 'is days ago';
    }

    public function getTitle()
    {
        return sprintf('"%s" is %s days ago', $this->getDataFieldName(), $this->Value1);
    }

    public function getSQL()
    {
        return sprintf(
            'DATEDIFF(DATE(\'%s\'), DATE("%s")) >= %s',
            DBDatetime::now()->getValue(),
            $this->DataField,
            Convert::raw2sql($this->Value1)
        );
    }

    protected function getSQLOperator()
    {
        return 'BETWEEN';
    }

}
