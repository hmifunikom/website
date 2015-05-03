<?php namespace HMIF\Console\Commands;

use Storage;
use Illuminate\Console\Command;
use PhpMimeMailParser\Parser;
class EmailParserCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'email:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses an incoming email.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $fd = fopen("php://stdin", "r");
        $rawEmail = "";
        while ( ! feof($fd))
        {
            $rawEmail .= fread($fd, 1024);
        }
        fclose($fd);

        $parser = new Parser();
        $parser->setText($rawEmail);

        $to = $parser->getHeader('to');
        $from = $parser->getHeader('from');
        $subject = $parser->getHeader('subject');
        $text = $parser->getMessageBody('text');

        $data = json_encode(compact('to', 'from', 'subject', 'text'));
        Storage::append('mail.txt', $data);
    }

    ///**
    // * Get the console command arguments.
    // *
    // * @return array
    // */
    //protected function getArguments()
    //{
    //	return [
    //		['example', InputArgument::REQUIRED, 'An example argument.'],
    //	];
    //}
    //
    ///**
    // * Get the console command options.
    // *
    // * @return array
    // */
    //protected function getOptions()
    //{
    //	return [
    //		['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
    //	];
    //}

}
