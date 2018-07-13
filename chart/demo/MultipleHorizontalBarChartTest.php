<?php
	/* Libchart - PHP chart library
	 * Copyright (C) 2005-2011 Jean-Marc Tr�meaux (jm.tremeaux at gmail.com)
	 * 
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 */
	
	/**
	 * Multiple horizontal bar chart demonstration.
	 *
	 */

	include "../libchart/classes/libchart.php";

	$chart = new HorizontalBarChart(450, 250);

	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("18-24", 22));
	$serie1->addPoint(new Point("25-34", 17));
	$serie1->addPoint(new Point("35-44", 20));
	$serie1->addPoint(new Point("45-54", 25));
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("18-24", 13));
	$serie2->addPoint(new Point("25-34", 18));
	$serie2->addPoint(new Point("35-44", 23));
	$serie2->addPoint(new Point("45-54", 22));
	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Male", $serie1);
	$dataSet->addSerie("Female", $serie2);
	$chart->setDataSet($dataSet);

	$chart->setTitle("Firefox vs IE users: Age");
	$chart->render("generated/demo8.png");
?>

