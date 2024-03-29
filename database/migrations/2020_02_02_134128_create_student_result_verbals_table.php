<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentResultVerbalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        create view `student_result_verbal` as
                (
                  Select
                      olsat.final_student_datas.id,
                      olsat.final_student_datas.student_id,
                      olsat.final_student_datas.student_name,
                      olsat.final_student_datas.verbal_comprehension,
                      olsat.final_student_datas.verbal_reasoning,
                      olsat.final_student_datas.verbal_total_score,
                      olsat.raw_to_scaled_verbal.scaledscore As verbal_scaled_score,
                      olsat.scaled_to_sai_verbal.sai As verbal_sai,
                      olsat.sai_to_percentile_rank_and_stanines.percentile_rank As verbal_percentile_rank,
                      olsat.sai_to_percentile_rank_and_stanines.stanine As verbal_stanine,
                      olsat.sai_to_percentile_rank_and_stanines.classification As verbal_classification,
                      olsat.final_student_datas.batch,
                      olsat.final_student_datas.exam_date
                  From
                      olsat.final_student_datas Inner Join
                      olsat.raw_to_scaled_verbal On olsat.raw_to_scaled_verbal.rawscore = olsat.final_student_datas.verbal_total_score
                      Inner Join
                      olsat.scaled_to_sai_verbal On
                              olsat.scaled_to_sai_verbal.age = olsat.final_student_datas.rounded_current_age_in_years
                              And olsat.scaled_to_sai_verbal.month = olsat.final_student_datas.rounded_current_age_in_months
                              And olsat.scaled_to_sai_verbal.gradescore = olsat.raw_to_scaled_verbal.scaledscore Inner Join
                      olsat.sai_to_percentile_rank_and_stanines On olsat.sai_to_percentile_rank_and_stanines.sai =
                              olsat.scaled_to_sai_verbal.sai
                )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      DB::statement("drop view student_result_verbal");
    }
}
