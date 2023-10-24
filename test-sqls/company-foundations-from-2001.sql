set @@cte_max_recursion_depth = 10000;
WITH recursive DATES AS (
    select '2001-01-01' as `date`
   union all
   select `date` + interval 1 day
   from DATES
   where `date` < CURRENT_TIMESTAMP())
SELECT `date`, c.company_name as company  FROM DATES
LEFT JOIN companies c ON c.company_foundation_date = DATES.`date`;