<?php namespace HMIF\Console\Commands;

use HMIF\Libraries\EmailStorer;
use Illuminate\Console\Command;

class EmailParserCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'emailparse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses an incoming email.';

    private $emailStorer;

    /**
     * Create a new command instance.
     *
     * @param EmailStorer $emailStorer
     */
    public function __construct(EmailStorer $emailStorer)
    {
        parent::__construct();

        $this->emailStorer = $emailStorer;
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

        $this->emailStorer->setRaw($rawEmail)->setType('in');
        $this->emailStorer->save();
    }

}
