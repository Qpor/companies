SET @columns = NULL;
SELECT GROUP_CONCAT(
	DISTINCT(
		CONCAT('(SELECT x.company_name FROM companies x WHERE x.activity = \'',c.activity,'\' AND x.company_id = c.company_id) as `', c.activity, '`')
	)
) INTO @columns
FROM companies c;

SET @sql=CONCAT('SELECT ', @columns , ' FROM companies c');

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;